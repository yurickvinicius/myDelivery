<?php

namespace myDelivery\Models;

use Illuminate\Database\Eloquent\Model;

class FlavorImage extends Model {

    protected $fillable = [
        'flavor_id',
        'extension'
    ];
    
    public function flavor(){
        return $this->belongsTo('myDelivery\Models\Flavor');
    }

}
