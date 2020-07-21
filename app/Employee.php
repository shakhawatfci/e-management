<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
   
    // relation with employee education 

    public  function employee_education(){

        return $this->hasMany('App\EmployeeEducation');
    }

    // relation with employee expereince 

    public function employee_experience()
    {
        return $this->hasMany('App\EmployeeExperience');
    }

    // relation with user 

    public function user()
    {
        return $this->hasOne('App\User');
    }

    // relation with employee salary 

    public function employee_salary()
    {
        return $this->hasMany('App\EmployeeSalary');
    }
}
