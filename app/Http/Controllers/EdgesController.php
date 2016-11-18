<?php

namespace myDelivery\Http\Controllers;

use Illuminate\Http\Request;

use myDelivery\Models\EdgePizza;
use myDelivery\Models\Order;
use myDelivery\Http\Requests\EdgeRequest;

class EdgesController extends Controller
{
    private $edgePizzaModel;

    public function __construct(EdgePizza $edgePizza) {
        $this->edgePizzaModel = $edgePizza;
        view()->share('totalOrders', Order::totalOrdersWaiting());
    }

    public function index(){
        $edges = $this->edgePizzaModel->where('in_use','<>','n')->paginate();
        return view('admin.edges.index', compact('edges'));
    }

    public function create(){
        return view('admin.edges.create');
    }

    public function store(EdgeRequest $request){
        $this->edgePizzaModel->create($request->all());
        return redirect()->route('admin.edges.index');
    }

    public function edit($id){
        $edge = $this->edgePizzaModel->find($id);
        return view('admin.edges.edit', compact('edge'));
    }

    public function update(EdgeRequest $reques, $id){
        $this->edgePizzaModel->find($id)->update($reques->all());

        return redirect()->route('admin.edges.index');
    }

    public function destroy($id){
        ///$this->edgePizzaModel->find($id)->delete();

        $this->edgePizzaModel
            ->find($id)
            ->update(
                [
                    'in_use' => 'n',
                ]
            );

        $message = 'Borda removida com sucesso!';
        return redirect()->route('admin.edges.index')->withMessageSuccess($message);
    }
}
