<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OthersExpense extends Model
{
    protected $table='others_expense';

    // relation with expense category
    public function expense_category(){
        
        return $this->belongsTo('App\ExpenseCategory');

    }

    // relation with project 

    public function project(){


    	return $this->belongsTo('App\Project');
    }


}
