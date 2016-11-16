<?php

namespace myDelivery\Models;

use Illuminate\Database\Eloquent\Model;
use myDelivery\Models\Order;

class Report extends Model
{

    public static function orders($request){

        $startDate = $request->input('startDate').' 00:00:00';
        $endDate = $request->input('endDate').' 23:59:00';
        $status = $request->input('status');

        if($status == 'Todos'){
            $orders = Order::where('created_at','>=', $startDate)
            ->where('created_at', '<=', $endDate)            
            ->get();
        }else{
            $orders = Order::where('created_at','>=', $startDate)
            ->where('created_at', '<=', $endDate)
            ->where('status', $status)
            ->get();
        }

        return $orders;
    }

}
