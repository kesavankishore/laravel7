<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   

   protected $fillable = [
       'code', 'name', 'price', 'stock',
    ];

    // public function sluggable(){
    //     return [
    //         'slug' => [
    //             'source' => 'name'
    //      ]
    // ];
    // }
}