<?php

namespace myDelivery\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    protected $fillable = [
        'total',
        'status',
        'type_order',
        'user_id',
        'in_use',
        'delivery_mean_id',
        'payment_form_id',
        'client_id'
    ];

    public static function totalOrdersWaiting() {
        return Order::where('status','<>','Entregue')->count();
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

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function deliverie() {
        return $this->hasOne(Deliverie::class);
    }

    public function client() {
        return $this->belongsTo(Client::class);
    }

}
