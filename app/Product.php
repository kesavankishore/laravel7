<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   

   protected $fillable = [
       'name', 'price', 'pic',
    ];

    // public function sluggable(){
    //     return [
    //         'slug' => [
    //             'source' => 'name'
    //      ]
    // ];
    // }
}