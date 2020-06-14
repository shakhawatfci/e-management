<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    protected $table='expense_category';

    // relation with project expense 

    public function project_expense(){

    	return $this->hasMany('App\OthersExpense',' 	expense_category_id');
    }

 // relation with Equipement expense 

    public function equipement_expense(){

    	return $this->hasMany('App\EquipementExpense',' 	expense_category_id');
    }


}
