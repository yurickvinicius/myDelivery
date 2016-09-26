<?php

namespace myDelivery\Models;

use Illuminate\Database\Eloquent\Model;

class PizzaBuilt extends Model {

    protected $fillable = [
        'observation',
        'edge_pizza_id',
        'size_pizza_id',
    ];

    public function orderPizza() {
        return $this->hasOne(OrderPizza::class);
    }

    public function edgePizza() {
        return $this->belongsTo(EdgePizza::class);
    }

    public function sizePizza() {
        return $this->belongsTo(SizePizza::class);
    }

    public function flavorsPizza() {
        return $this->hasMany(FlavorsPizza::class);
    }

}
