<?php

namespace myDelivery\Models;

use Illuminate\Database\Eloquent\Model;

class Drink extends Model {

    protected $fillable = [
        'name',
        'price'
    ];

    public function orderDrink() {
        return $this->hasOne(OrderDrink::class);
    }

}
