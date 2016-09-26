<?php

namespace myDelivery\Models;

use Illuminate\Database\Eloquent\Model;

class SizePizza extends Model {

    protected $fillable = [
        'size',
        'price',
        'parts'
    ];

}
