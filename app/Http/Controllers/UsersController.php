<?php

namespace myDelivery\Http\Controllers;

use Illuminate\Http\Request;

use myDelivery\Http\Requests;
use myDelivery\Models\User;
use myDelivery\Models\Client;

class UsersController extends Controller
{
    public function searchClient($data){     
           
        if(is_numeric($data)){        
        $datas = Client::where('cell_phone', 'like', "____$data%")
                ->orWhere('phone', 'like', "____$data%")
                ->with(['user'])
                ->get();
        
        }else                
            $datas = User::where('name','iLIKE', "$data%")->with(['client'])->get();        
        
        return json_encode($datas);
    }
}
