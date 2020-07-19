<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeSalary extends Model
{
    // relation with employee 

    public function employee()
    {
        return $this->belongsTo('App\Employee')->withDefault([
            'id' => 0,
            'name' => 'Deleted Employee',
        ]);
    }
}
