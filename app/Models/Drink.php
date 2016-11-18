<?php

namespace myDelivery\Models;

use Illuminate\Database\Eloquent\Model;

class Drink extends Model {

    protected $fillable = [
        'name',
        'price',
        'in_use'
    ];

    public function orderDrink() {
        return $this->hasOne(OrderDrink::class);
    }

}
