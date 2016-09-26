<?php

namespace myDelivery\Http\Controllers;

use Illuminate\Http\Request;
use myDelivery\Http\Requests;
use myDelivery\Models\Order;
use myDelivery\Models\User;
use myDelivery\Models\Deliverie;
use myDelivery\Models\Drink;
use myDelivery\Models\Flavor;
use myDelivery\Models\EdgePizza;
use myDelivery\Models\SizePizza;
use myDelivery\Models\PizzaBuilt;
use myDelivery\Models\FlavorsPizza;
use myDelivery\Models\PaymentForm;
use myDelivery\Models\OrderPizza;
use myDelivery\Models\OrderDrink;
use myDelivery\Http\Requests\DeliverieRequest;
use Illuminate\Support\Facades\Auth;

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

    public function __construct(Order $order, Deliverie $deliverie, Flavor $flavor, EdgePizza $edge, SizePizza $sizePizza, Drink $drink, PizzaBuilt $pizzaBuilt, FlavorsPizza $flavorsPizza, PaymentForm $paymentForm, OrderPizza $orderPizza, OrderDrink $orderDrink) {
        $this->orderModel = $order;
        view()->share('totalOrders', Order::totalOrders());
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
    }

    public function index() {
        $orders = $this->orderModel->paginate(50);

        ///dd($orders[0]->orderPizzas->find(1)->pizzaBuilts);
        ///$orders = $this->orderModel->with(['orderPizzas'])->with(['pizzaBuilts'])->find('1');        
        ///$orders = $this->orderModel->where('id', 1)->with('orderPizzas')->get();
        ///dd($orders[1]->orderPizzas->find(2)->pizzaBuilts->find(2)->flavorsPizza->find(2)->flavor);

        return view('orders.index', compact('orders'));
    }

    public function show($id) {
        $deliverymens = User::where('role', 'Entregador')->get();
        $order = $this->orderModel->find($id);

        return view('orders.show', compact('order', 'deliverymens'));
    }

    public function sendOrder(DeliverieRequest $request) {
        $Delivery = [
            'user_id' => $request->input('deliverymean_id'),
            'order_id' => $request->input('order_id')
        ];

        $this->deliverieModel->create($Delivery);

        //// atualizando status em order
        $this->orderModel->find($request->input('order_id'))->update(['status' => 'Enviado']);

        $message = 'Pedido atualizado com suecesso!';
        return redirect()->route('orders.index')->withMessageSuccess($message);
    }

    public function create() {
        $flavors = $this->flavorModel->all();
        $edges = $this->edgeModel->all();
        $sizePizzas = $this->sizePizzaModel->all();
        $drinks = $this->drinkModel->all();

        return view('orders.create', compact('flavors', 'edges', 'sizePizzas', 'drinks'));
    }

    public function store(Request $request) {
        ///dd($request);

        /// save payment form ////////////////
        $tablePaymentForm = [
            'form' => 'Dinheiro',
            'status' => 'Aberto',
            'exchange_money' => null
        ];

        $paymentForm = $this->paymentFormModel->create($tablePaymentForm);

        /// save order ///////////////////////////
        $tableOrder = [
            'total' => $request->input('total'),
            'status' => 'Aberto',
            'type_order' => 'Pizza',
            'user_id' => Auth::user()->id,
            'delivery_mean_id' => 1,
            'payment_form_id' => $paymentForm->id
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
                $tableFlavorsPizza = [
                    'pizza_built_id' => $pizzaBuilt->id,
                    'flavor_id' => $flavor
                ];

                $this->flavorsPizzaModel->create($tableFlavorsPizza);
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
            $tableOrderDrink = [
                'drink_id' => $option,
                'order_id' => $order->id
            ];

            $this->orderDrinkModel->create($tableOrderDrink);
        }
        dd();
    }

}
