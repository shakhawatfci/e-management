<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfficeExpenseHead extends Model
{
    public function office_expense()
    {
    	return $this->hasOne('App\OfficeExpense');
    }
}
