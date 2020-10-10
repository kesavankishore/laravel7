<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
       'orderId', 'code', 'name', 'price', 'stock', 'qnty', 'total',
    ];
}
