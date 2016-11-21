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

    public function __construct(Order $order, Deliverie $deliverie, Flavor $flavor, EdgePizza $edge, SizePizza $sizePizza, Drink $drink, PizzaBuilt $pizzaBuilt, FlavorsPizza $flavorsPizza, PaymentForm $paymentForm, OrderPizza $orderPizza, OrderDrink $orderDrink, DeliveryMean $deliveryMean, Client $client) {
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
        $flavors = $this->flavorModel->all();
        $edges = $this->edgeModel->all();
        $sizePizzas = $this->sizePizzaModel->all();
        $drinks = $this->drinkModel->all();
        $deliveryMeans = $this->deliveryMeanModel->all();

        return view('orders.create', compact('flavors', 'edges', 'sizePizzas', 'drinks', 'deliveryMeans'));
    }

    public function store(OrderRequest $request) {
        ///dd($request);
        /// save payment form ////////////////
        $tablePaymentForm = [
            'form' => 'Dinheiro',
            'status' => 'Aberto',
            'exchange_money' => null
        ];

        $paymentForm = $this->paymentFormModel->create($tablePaymentForm);

        /// savle client
        $notChar = array("(", ")", "-");
        $cellPhone = str_replace($notChar, "", $request->input('cadTelCellPhone'));
        $Phone = str_replace($notChar, "", $request->input('cadTelPhone'));
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

        /// save order ///////////////////////////
        $tableOrder = [
            'total' => $request->input('total'),
            'status' => 'Aberto',
            'type_order' => 'Pizza',
            'user_id' => Auth::user()->id,
            'delivery_mean_id' => $request->input('delivery_means'),
            'payment_form_id' => $paymentForm->id,
            'client_id' => $client->id
        ];

        $order = $this->orderModel->create($tableOrder);

        //// save built pizza ////////////////////////
        foreach ($request->pizza as $pizza) {
            $tablePizzaBuilt = [
                'parts' => 1, //// eliminar este campo
                'observation' => $pizza['observation'],
                'edge_pizza_id' => $pizza['edge'],
                'size_pizza_id' => $pizza['size']
            ];

            $pizzaBuilt = $this->pizzaBuiltModel->create($tablePizzaBuilt);

            /// save flavors_pizzas ////////////////////
            foreach ($pizza['flavor'] as $flavor) {

                if($flavor > 0){
                    for ($i=0; $i < $flavor; $i++) {
                        $tableFlavorsPizza = [
                            'pizza_built_id' => $pizzaBuilt->id,
                            'flavor_id' => $flavor
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

        /// save order drinks
        foreach ($request->option as $option) {
            if($option !=0){
                $tableOrderDrink = [
                    'drink_id' => $option,
                    'order_id' => $order->id
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
