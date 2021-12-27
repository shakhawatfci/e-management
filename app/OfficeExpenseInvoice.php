<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfficeExpenseInvoice extends Model
{
    public function office_expense()
    {
    	return $this->hasMany('App\OfficeExpense');
    }
}
