<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfficeExpense extends Model
{
    public function office_expense_head()
    {
    	return $this->belongsTo('App\OfficeExpenseHead');
    }
    public function office_expense_invoice()
    {
    	return $this->belongsTo('App\OfficeExpenseInvoice');
    }
}
