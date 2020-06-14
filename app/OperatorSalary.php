<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OperatorSalary extends Model
{
    protected $table='operator_salaries';

    // relation with operator info 

    public function operator(){
    	
    	return $this->belongsTo('App\Operator');
    }
}
