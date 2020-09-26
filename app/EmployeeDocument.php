<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeDocument extends Model
{
    protected $fillable = [
        'emp_id', 'originalName', 'emp_doc', 
     ];

     protected $hidden = [
        'created_at', 'updated_at'
   ];

   
}
