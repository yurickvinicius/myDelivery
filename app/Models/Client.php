<?php

namespace myDelivery\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model {

    protected $fillable = [
        'name',
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
    
    public function user(){
        return $this->belongsTo(User::class);
    }

}
