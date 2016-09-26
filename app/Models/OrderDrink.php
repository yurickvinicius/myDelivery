<?php

namespace myDelivery\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDrink extends Model {

    protected $fillable = [
        'drink_id',
        'order_id'
    ];

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function drinks() {
        return $this->hasMany(Drink::class, 'id', 'drink_id');
    }

    /*
      public function drinks() {
      return $this->hasOne(Drink::class, 'id');
      }
     * 
     */
}
