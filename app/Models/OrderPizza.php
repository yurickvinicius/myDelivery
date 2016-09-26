<?php

namespace myDelivery\Models;

use Illuminate\Database\Eloquent\Model;

class OrderPizza extends Model {

    protected $fillable = [
        'pizza_built_id',
        'order_id'
    ];

    public function order() {
        return $this->belongsTo(Order::class);
    }
    
    public function pizzaBuilts(){
        return $this->hasMany(PizzaBuilt::class, 'id', 'pizza_built_id');
    }

}
