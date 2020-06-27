<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectExpense extends Model
{
	protected $table ='project_expenses';
	
    public function project_expense_head()
    {
    	return $this->belongsTo('App\ProjectExpenseHead');
    }

    public function project()
    {
    	return $this->belongsTo('App\Project');
    }
}
