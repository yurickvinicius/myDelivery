<?php

namespace myDelivery\Http\Controllers;

use Illuminate\Http\Request;
use myDelivery\Http\Requests;
use myDelivery\Models\Client;

class ClientsController extends Controller {

    public function searchClient($data) {

        if (is_numeric($data)) {
            $datas = Client::where('cell_phone', 'like', "__$data%")
                    ->orWhere('phone', 'like', "__$data%")
                    ->limit(6)
                    ->get();
        } else {
            $datas = Client::where('name', 'iLIKE', "$data%")->get();
        }

        return json_encode($datas);
    }

}
