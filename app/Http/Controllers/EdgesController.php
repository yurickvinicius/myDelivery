<?php

namespace myDelivery\Http\Controllers;

use Illuminate\Http\Request;

use myDelivery\Http\Requests;
use myDelivery\Models\EdgePizza;
use myDelivery\Models\Order;

class EdgesController extends Controller
{
    private $edgePizzaModel;

    public function __construct(EdgePizza $edgePizza) {
        $this->edgePizzaModel = $edgePizza;
        view()->share('totalOrders', Order::totalOrders());
    }
    
    public function index(){
        $edges = $this->edgePizzaModel->paginate();
        return view('admin.edges.index', compact('edges'));
    }
}
