<?php

namespace myDelivery\Http\Controllers;

use myDelivery\Http\Requests\AdminDrinkRequest;
use myDelivery\Models\Drink;
use myDelivery\Models\Order;

class DrinksController extends Controller
{
    private $drinkModel;

    public function __construct(Drink $drink) {
        $this->drinkModel = $drink;
        view()->share('totalOrders', Order::totalOrdersWaiting());
    }

    public function index(){
        $drinks = $this->drinkModel->where('in_use', '<>', 'n')->orderBy('id', 'desc')->paginate();
        return view('admin.drinks.index', compact('drinks'));
    }

    public function create(){
        return view('admin.drinks.create');
    }

    public function store(AdminDrinkRequest $reques){
        $data = $reques->all();
        $this->drinkModel->create($data);

        return redirect()->route('admin.drinks.index');
    }

    public function edit($id){
        $drink = $this->drinkModel->find($id);
        return view('admin.drinks.edit', compact('drink'));
    }

    public function update(AdminDrinkRequest $reques, $id){
        $data = $reques->all();
        $this->drinkModel->find($id)->update($data);

        return redirect()->route('admin.drinks.index');
    }

    public function destroy($id){
        ///$this->drinkModel->find($id)->delete();

        $this->drinkModel
            ->find($id)
            ->update(
                [
                    'in_use' => 'n',
                ]
            );

        $message = 'Opção removida com sucesso!';
        return redirect()->route('admin.drinks.index')->withMessageSuccess($message);
    }
}
