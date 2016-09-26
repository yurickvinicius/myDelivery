<?php

namespace myDelivery\Http\Controllers;

use Illuminate\Http\Request;
use myDelivery\Http\Requests;
use myDelivery\Models\SizePizza;
use myDelivery\Models\Order;

class SizesController extends Controller
{
    private $sizePizzaModel;
    
    public function __construct(SizePizza $sizePizza) {
        $this->sizePizzaModel = $sizePizza;
        view()->share('totalOrders', Order::totalOrders());
    }
    
    public function index(){
        $sizePizzas = $this->sizePizzaModel->paginate();
        return view('admin.sizes.index', compact('sizePizzas'));
    }
}
