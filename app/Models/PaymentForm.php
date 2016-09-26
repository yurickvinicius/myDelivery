<?php

namespace myDelivery\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentForm extends Model {

    protected $fillable = [
        'form',
        'status',
        'exchange_money'
    ];

}
