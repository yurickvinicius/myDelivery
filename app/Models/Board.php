<?php

namespace myDelivery\Models;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
  protected $fillable = [
      'name',
      'number',
  ];
}
