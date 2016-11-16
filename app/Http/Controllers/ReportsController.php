<?php

namespace myDelivery\Http\Controllers;

use Illuminate\Http\Request;

use myDelivery\Http\Requests\ReportOrderRequest;
use myDelivery\Models\Report;
use myDelivery\Models\Order;

class ReportsController extends Controller
{

    public function __construct() {
        view()->share('totalOrders', Order::totalOrders());
    }

    public function index(){
        return view('admin.reports.orders.index');
    }

    public function reportOrders(ReportOrderRequest $request){
        $reports = Report::orders($request);
        $status = $request->input('status');
        return view('admin.reports.orders.show', compact('reports','status'));
    }
}
