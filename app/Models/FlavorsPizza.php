<?php

namespace myDelivery\Models;

use Illuminate\Database\Eloquent\Model;

class FlavorsPizza extends Model {

    protected $fillable = [
        'pizza_built_id',
        'flavor_id'
    ];
    
    public function flavor(){        
        return $this->belongsTo(Flavor::class);
    }

}
