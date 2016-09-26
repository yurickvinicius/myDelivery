<?php

namespace myDelivery\Models;

use Illuminate\Database\Eloquent\Model;

class Flavor extends Model {

    protected $fillable = [
        'name',
        'description',
        'price',
        'img'
    ];

    public function images() {
        return $this->hasMany(FlavorImage::class);
    }

}
