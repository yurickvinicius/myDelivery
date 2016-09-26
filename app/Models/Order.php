<?php

namespace myDelivery\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    protected $fillable = [
        'total',
        'status',
        'type_order',
        'user_id',
        'delivery_mean_id',
        'payment_form_id'
    ];
    
    public static function totalOrders(){
        return Order::count();
    }

    public function orderPizzas() {
        return $this->hasMany(OrderPizza::class);
    }

    public function orderDrinks() {
        return $this->hasMany(OrderDrink::class);
    }

    public function paymentForm() {
        return $this->belongsTo(PaymentForm::class);
    }

    public function deliveryMean() {
        return $this->belongsTo(DeliveryMean::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function deliverie(){
        return $this->hasOne(Deliverie::class);
    }

}
