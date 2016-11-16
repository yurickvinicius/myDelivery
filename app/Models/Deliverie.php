<?php

namespace myDelivery\Models;

use Illuminate\Database\Eloquent\Model;

class Deliverie extends Model {

    protected $fillable = [
        'user_id',
        'order_id'
    ];
    
    public function user(){
        return $this->belongsTo(User::class);
    }

}
