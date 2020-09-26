<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    
    protected $fillable = [
        'employee_name', 'employee_email', 'employee_salary', 'employee_address',
     ];

     protected $hidden = [
        'created_at', 'updated_at'
   ];

   public function document()
    {
        return $this->hasOne('App\EmployeeDocument', 'emp_id');
    }
}
