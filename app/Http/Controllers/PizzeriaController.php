<?php

namespace myDelivery\Http\Controllers;

use Illuminate\Http\Request;
use myDelivery\Http\Requests;
use myDelivery\Models\EdgePizza;
use myDelivery\Models\SizePizza;
use myDelivery\Models\Flavor;
use myDelivery\Models\Drink;
use myDelivery\Models\DeliveryMean;
use myDelivery\Models\PizzaBuilt;
use myDelivery\Models\FlavorsPizza;
use myDelivery\Models\Order;
use myDelivery\Models\PaymentForm;
use myDelivery\Models\OrderPizza;
use myDelivery\Models\OrderDrink;
use Illuminate\Support\Facades\Auth;
use laravel\pagseguro\Config\Config;
use laravel\pagseguro\Credentials\Credentials;
use laravel\pagseguro\Checkout\Facade\CheckoutFacade;

class PizzeriaController extends Controller {

    private $edgePizzaModel;
    private $sizePizzaModel;
    private $flavorModel;
    private $drinkModel;
    private $deliveryMeanModel;
    private $pizzaBuiltModel;
    private $flavorsPizzaModel;
    private $orderModel;
    private $paymentFormModel;
    private $orderPizzaModel;
    private $orderDrinkModel;

    public function __construct(EdgePizza $edgePizza, SizePizza $sizePizza, Flavor $flavor, Drink $drink, DeliveryMean $deliveryMean, PizzaBuilt $pizzaBuilt, FlavorsPizza $flavorsPizza, Order $order, PaymentForm $paymentForm, OrderPizza $orderPizza, OrderDrink $orderDrink) {
        $this->edgePizzaModel = $edgePizza;
        $this->sizePizzaModel = $sizePizza;
        $this->flavorModel = $flavor;
        $this->drinkModel = $drink;
        $this->deliveryMeanModel = $deliveryMean;
        $this->pizzaBuiltModel = $pizzaBuilt;
        $this->flavorsPizzaModel = $flavorsPizza;
        $this->orderModel = $order;
        $this->paymentFormModel = $paymentForm;
        $this->orderPizzaModel = $orderPizza;
        $this->orderDrinkModel = $orderDrink;
    }

    public function index() {        
        return view('pizzeria.index');
    }

    public function order() {

        $edgePizzas = $this->edgePizzaModel->lists('name', 'id');
        $sizePizzas = $this->sizePizzaModel->all();
        $flavors = $this->flavorModel->all();
        $drinks = $this->drinkModel->all();
        $deliveryMeans = $this->deliveryMeanModel->all();

        return view('pizzeria.order', compact('edgePizzas', 'sizePizzas', 'flavors', 'drinks', 'deliveryMeans'));
    }

    public function store(Request $request) {

        ///dd($request);

        $flavorsId = $request->input('flavors_id');

        /// save pizza_builts
        $tablePizzaBuilt = [
            'parts' => $request->input('parts'),
            'observation' => $request->input('observation'),
            'edge_pizza_id' => $request->input('edge_pizza_id'),
            'size_pizza_id' => $request->input('size_pizza_id')
        ];

        $pizzaBuilt = $this->pizzaBuiltModel->create($tablePizzaBuilt);

        /// save flavors_pizzas
        foreach ($flavorsId as $flavorId) {
            $tableFlavorsPizza = [
                'pizza_built_id' => $pizzaBuilt->id,
                'flavor_id' => $flavorId
            ];

            $this->flavorsPizzaModel->create($tableFlavorsPizza);
        }

        /// save payment form
        $tablePaymentForm = [
            'form' => $request->input('payment_form'),
            'status' => 'Aberto',
            'exchange_money' => $request->input('exchange_money')
        ];

        $paymentForm = $this->paymentFormModel->create($tablePaymentForm);

        /// save order
        $tableOrder = [
            'total' => $request->input('total'),
            'status' => 'Aberto',
            'type_order' => 'Pizza',
            'user_id' => Auth::user()->id,
            'delivery_mean_id' => $request->input('delivery_mean_id'),
            'payment_form_id' => $paymentForm->id
        ];

        $order = $this->orderModel->create($tableOrder);

        /// save order pizzas
        $tableOrderPizza = [
            'pizza_built_id' => $pizzaBuilt->id,
            'order_id' => $order->id
        ];

        $this->orderPizzaModel->create($tableOrderPizza);

        /// save order drinks
        $tableOrderDrink = [
            'drink_id' => $request->input('drink_id'),
            'order_id' => $order->id
        ];

        $this->orderDrinkModel->create($tableOrderDrink);

        if ($request->input('payment_form') == 'PagSeguro')
            $this->pagSeguro();
        else
            return redirect()->back()->withMessageSuccess('Pedido realizado com sucesso. Tempo médio para receber é de 35 minutos.');
    }

    public function pagSeguro() {

        $data = [
            'items' => [
                [
                    'id' => '18',
                    'description' => 'Item Um',
                    'quantity' => '1',
                    'amount' => '13.15',
                    'weight' => '45',
                    'width' => '50',
                    'height' => '45',
                    'length' => '60',
                ],
            ],
            'sender' => [
                'email' => 'sender@gmail.com',
                'name' => 'Isaque de Souza Barbosa',
                'documents' => [
                    [
                        'number' => '01234567890',
                        'type' => 'CPF'
                    ]
                ],
                'phone' => '11985445522',
                'bornDate' => '1988-03-21',
            ]
        ];

        Config::set('use-sandbox', true);  ///// usando o sandbox
        $facade = new CheckoutFacade();
        $checkout = $facade->createFromArray($data);
        $credentials = new Credentials('8DE8D28446B1473CA17E31A0DFEDFBD5', 'yurickvinicius@gmail.com');
        $information = $checkout->send($credentials); // Retorna um objeto de laravel\pagseguro\Checkout\Information\Information

        if ($information) {
            print_r($information->getCode());
            print_r($information->getDate());
            print_r($information->getLink());
        }
    }

    public function getPagSeguro($code) {
        echo 'teste: ';
        echo $code;

        dd();
    }

}
