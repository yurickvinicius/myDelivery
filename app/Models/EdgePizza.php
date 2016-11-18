<?php

namespace myDelivery\Models;

use Illuminate\Database\Eloquent\Model;

class EdgePizza extends Model {

    protected $fillable = [
        'name',
        'price',
        'in_use'
    ];

}
