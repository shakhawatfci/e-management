<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
   protected $table='operators';

   // relation with operator salary

   public function salary(){
    
    return $this->hasMany('App\OperatorSalary');

   }
}
