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

   public function car_assign()
   {
      return $this->hasMany('App\CarAssign');
   }

   public function operator_fooding(){

        return $this->hasMany('App\OperatorFooding');
    }
}
