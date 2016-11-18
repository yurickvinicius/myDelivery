<?php

namespace myDelivery\Http\Controllers;

use Illuminate\Http\Request;

use myDelivery\Http\Requests\DeliveryMeanRequest;
use myDelivery\Models\DeliveryMean;
use myDelivery\Models\Order;

class DeliveryMeansController extends Controller
{
    private $deliveryMeanModel;

    public function __construct(DeliveryMean $deliveryMean) {
        $this->deliveryMeanModel = $deliveryMean;
        view()->share('totalOrders', Order::totalOrdersWaiting());
    }

    public function index(){
        $deliverymeans = $this->deliveryMeanModel->where('in_use','<>','n')->paginate();
        return view('admin.deliverymeans.index', compact('deliverymeans'));
    }

    public function create(){
        return view('admin.deliverymeans.create');
    }

    public function store(DeliveryMeanRequest $request){
        $this->deliveryMeanModel->create($request->all());
        return redirect()->route('admin.deliverymeans.index');
    }

    public function edit($id){
        $deliverymean = $this->deliveryMeanModel->find($id);
        return view('admin.deliverymeans.edit', compact('deliverymean'));
    }

    public function update(DeliveryMeanRequest $reques, $id){
        $this->deliveryMeanModel->find($id)->update($reques->all());

        return redirect()->route('admin.deliverymeans.index');
    }

    public function destroy($id){
        ///$this->deliveryMeanModel->find($id)->delete();

        $this->deliveryMeanModel
            ->find($id)
            ->update(
                [
                    'in_use' => 'n',
                ]
            );

        $message = 'Forma de entrega removido com suecesso!';
        return redirect()->route('admin.deliverymeans.index')->withMessageSuccess($message);
    }
}
