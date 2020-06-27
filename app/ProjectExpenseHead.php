<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectExpenseHead extends Model
{
	protected $table ='project_expense_heads';

    public function project_expense()
    {
    	return $this->hasMany('App\ProjectExpense');
    }
}
