<?php

namespace myDelivery\Http\Controllers;

use Illuminate\Http\Request;
use myDelivery\Http\Requests;
use myDelivery\Models\Order;
use myDelivery\Models\User;
use myDelivery\Models\Deliverie;
use myDelivery\Models\DeliveryMean;
use myDelivery\Models\Drink;
use myDelivery\Models\Flavor;
use myDelivery\Models\EdgePizza;
use myDelivery\Models\SizePizza;
use myDelivery\Models\PizzaBuilt;
use myDelivery\Models\FlavorsPizza;
use myDelivery\Models\PaymentForm;
use myDelivery\Models\OrderPizza;
use myDelivery\Models\OrderDrink;
use myDelivery\Models\Client;
use myDelivery\Models\Board;
use myDelivery\Http\Requests\DeliverieRequest;
use Illuminate\Support\Facades\Auth;
use myDelivery\Http\Requests\OrderRequest;

class OrdersController extends Controller {

  private $orderModel;
  private $deliverieModel;
  private $flavorModel;
  private $edgeModel;
  private $sizePizzaModel;
  private $drinkModel;
  private $pizzaBuiltModel;
  private $flavorsPizzaModel;
  private $paymentFormModel;
  private $orderPizzaModel;
  private $orderDrinkModel;
  private $deliveryMeanModel;
  private $clientModel;
  private $boardModel;

  public function __construct(Order $order, Deliverie $deliverie, Flavor $flavor, EdgePizza $edge, SizePizza $sizePizza, Drink $drink, PizzaBuilt $pizzaBuilt, FlavorsPizza $flavorsPizza, PaymentForm $paymentForm, OrderPizza $orderPizza, OrderDrink $orderDrink, DeliveryMean $deliveryMean, Client $client, Board $board) {
    $this->orderModel = $order;
    view()->share('totalOrders', Order::totalOrdersWaiting());
    $this->deliverieModel = $deliverie;
    $this->flavorModel = $flavor;
    $this->edgeModel = $edge;
    $this->sizePizzaModel = $sizePizza;
    $this->drinkModel = $drink;
    $this->pizzaBuiltModel = $pizzaBuilt;
    $this->flavorsPizzaModel = $flavorsPizza;
    $this->paymentFormModel = $paymentForm;
    $this->orderPizzaModel = $orderPizza;
    $this->orderDrinkModel = $orderDrink;
    $this->deliveryMeanModel = $deliveryMean;
    $this->clientModel = $client;
    $this->boardModel = $board;
  }

  public function index() {
    $orders = $this->orderModel
    ->where('status', '<>', 'Entregue')
    ->where('status', '<>', 'Cancelado')
    ->paginate(20);

    return view('orders.index', compact('orders'));
  }

  public function show($id) {
    $deliverymens = User::where('role', 'Entregador')->where('in_use','<>','n')->get();
    $order = $this->orderModel->find($id);

    return view('orders.show', compact('order', 'deliverymens', 'deliverie'));
  }

  public function sendOrder(DeliverieRequest $request) {
    //dd($request);
    $delivery = $request->input('deliverymean_id');
    $delivered = $request->input('pizza_delivered');

    if ($delivered == 'nao' || $delivered == 'Preparando' || $delivered == 'Enviado') {
      $status = $this->generateStatus($delivery, $delivered);
      /// atualizando entregador
      if ($request->input('deliverymean_id') != 0) {
        $upDeliviry = $this->deliverieModel
        ->where('order_id', $request->input('order_id'))
        ->update(
          [
            'user_id' => $request->input('deliverymean_id')
          ]
        );

        if ($upDeliviry == 0) {
          $Delivery = [
            'user_id' => $request->input('deliverymean_id'),
            'order_id' => $request->input('order_id')
          ];
          $this->deliverieModel->create($Delivery);
        }
      }
    } else
    $status = 'Entregue';

    //// atualizando status em order
    $this->orderModel->find($request->input('order_id'))->update(
      [
        'status' => $status
      ]
    );

    $message = 'Pedido atualizado com suecesso!';
    return redirect()->route('orders.index')->withMessageSuccess($message);
  }

  public function create() {
    ///$flavors = $this->flavorModel->where('in_use', '<>', 'n')->get();
    ///$edges = $this->edgeModel->where('in_use', '<>', 'n')->get();
    ///$sizePizzas = $this->sizePizzaModel->where('in_use', '<>', 'n')->get();
    $options = $this->drinkModel->where('in_use', '<>', 'n')->get();
    $deliveryMeans = $this->deliveryMeanModel->all();

    return view('orders.create', compact('flavors', 'edges', 'sizePizzas', 'options', 'deliveryMeans'));
  }

  public function createPizzaJson(){
    $flavors = $this->flavorModel->where('in_use', '<>', 'n')->get();
    $edges = $this->edgeModel->where('in_use', '<>', 'n')->get();
    $sizePizzas = $this->sizePizzaModel->where('in_use', '<>', 'n')->get();

    /*foreach ($flavors as $flavor) {
    echo $flavor->images;
    $datas['flavorImgs'] = $flavor->images->lists($flavor->id)->first();
  }*/

  $datas['flavors'] = $flavors;
  $datas['edges'] = $edges;
  $datas['sizePizzas'] = $sizePizzas;

  //dd($datas);

  return json_encode($datas);
}

public function store(OrderRequest $request) {
  ///dd($request);
  $clientId = null;
  $deliveryMean = null;
  $boardId = null;
  /// save payment form ////////////////
  $tablePaymentForm = [
    'form' => 'Dinheiro',
    'status' => 'Aberto',
    'exchange_money' => null
  ];

  $paymentForm = $this->paymentFormModel->create($tablePaymentForm);

  /// save board
  if($request->input('cadBoard')){
    $tableBoard = [
      'name' => $request->input('cadResponsible'),
      'number' => $request->input('cadBoard')
    ];

    $board = $this->boardModel->create($tableBoard);
    $boardId = $board->id;
  }else{
    /// savle client
    $notChar = array("(", ")", "-");
    $cellPhone = str_replace($notChar, "", $request->input('cadTelCellPhone'));
    $Phone = str_replace($notChar, "", $request->input('cadTelPhone'));
    if($request->input('cadName')){
      $tableClient = [
        'name' => $request->input('cadName'),
        'cep' => $request->input('cadCEP'),
        'state' => null,
        'city' => null,
        'neighborhood' => $request->input('cadNeighborhood'),
        'address' => $request->input('cadAddress'),
        'number' => $request->input('cadNumber'),
        'complement' => $request->input('cadComplement'),
        'phone' => $Phone,
        'cell_phone' => $cellPhone,
        'user_id' => Auth::user()->id,
      ];

      $client = $this->clientModel->create($tableClient);
      $clientId = $client->id;
    }
  }

  /// save order ///////////////////////////
  if($request->input('delivery_means')){
    $deliveryMean = $request->input('delivery_means');
  }
  $tableOrder = [
    'total' => $request->input('total'),
    'status' => 'Aberto',
    'type_order' => 'Pizza',
    'user_id' => Auth::user()->id,
    'delivery_mean_id' => $deliveryMean,
    'payment_form_id' => $paymentForm->id,
    'client_id' => $clientId,
    'board_id' => $boardId,
  ];

  $order = $this->orderModel->create($tableOrder);

  //// save built pizza ////////////////////////
  if($request->pizza){
    foreach ($request->pizza as $pizza) {
      $tablePizzaBuilt = [
        'parts' => 1, //// eliminar este campo
        'observation' => $pizza['observation'],
        'edge_pizza_id' => $pizza['edge'],
        'size_pizza_id' => $pizza['size']
      ];

      $pizzaBuilt = $this->pizzaBuiltModel->create($tablePizzaBuilt);

      /// save flavors_pizzas ////////////////////
      foreach ($pizza['flavor'] as $key => $value) {

        if($value > 0){

          for ($i=0; $i < $value; $i++) {
            $tableFlavorsPizza = [
              'pizza_built_id' => $pizzaBuilt->id,
              'flavor_id' => $key
            ];
            $this->flavorsPizzaModel->create($tableFlavorsPizza);
          }
        }
      }

      /// save order pizzas ////////////////////
      $tableOrderPizza = [
        'pizza_built_id' => $pizzaBuilt->id,
        'order_id' => $order->id
      ];

      $this->orderPizzaModel->create($tableOrderPizza);
    }
  }

  /// save order drinks
  foreach ($request->input('option') as $key => $value) {
    if($value > 0){
      $tableOrderDrink = [
        'drink_id' => $key,
        'order_id' => $order->id,
        'amount' => $value
      ];
      $this->orderDrinkModel->create($tableOrderDrink);
    }
  }

  $message = 'Pedido realizado com sucesso!';
  return redirect()->route('orders.index')->withMessageSuccess($message);
}

private function generateStatus($delivery) {
  if ($delivery == 0) {
    $status = 'Preparando';
  } else if ($delivery != 0) {
    $status = 'Enviado';
  } else {
    $status = 'Aberto';
  }

  return $status;
}

public function cancelOrder($id){
  $this->orderModel
  ->find($id)
  ->update(
    [
      'in_use' => 'n',
      'status' => 'Cancelado'
    ]
  );

  $message = 'Pedido cancelado com suecesso!';
  return redirect()->route('orders.index')->withMessageSuccess($message);
}

}
