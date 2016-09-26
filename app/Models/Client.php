<?php

namespace myDelivery\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model {

    protected $fillable = [
        'cep',
        'state',
        'city',
        'neighborhood',
        'address',
        'number',
        'complement',
        'phone',
        'cell_phone',
        'user_id'
    ];

}
