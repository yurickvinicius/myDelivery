<?php

namespace myDelivery\Http\Controllers;

use myDelivery\Http\Requests;
use myDelivery\Models\SizePizza;
use myDelivery\Models\Order;
use myDelivery\Http\Requests\SizePizzaRequest;

class SizesController extends Controller
{
    private $sizePizzaModel;

    public function __construct(SizePizza $sizePizza) {
        $this->sizePizzaModel = $sizePizza;
        view()->share('totalOrders', Order::totalOrdersWaiting());
    }

    public function index(){
        $sizePizzas = $this->sizePizzaModel->paginate();
        return view('admin.sizes.index', compact('sizePizzas'));
    }

    public function create(){
        return view('admin.sizes.create');
    }

    public function store(SizePizzaRequest $request){
        $this->sizePizzaModel->create($request->all());
        return redirect()->route('admin.sizes.index');
    }

    public function edit($id){
        $size = $this->sizePizzaModel->find($id);
        return view('admin.sizes.edit', compact('size'));
    }

    public function update(SizePizzaRequest $reques, $id){
        $this->sizePizzaModel->find($id)->update($reques->all());

        return redirect()->route('admin.sizes.index');
    }

    public function destroy($id){
        $this->sizePizzaModel->find($id)->delete();

        return redirect()->route('admin.sizes.index');
    }
}
