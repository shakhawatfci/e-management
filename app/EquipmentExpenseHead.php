<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EquipmentExpenseHead extends Model
{
    public function equipement_expense()
    {
    	return $this->hasMany('App\EquipementExpense');
    }
}
