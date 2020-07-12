<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EquipmentType extends Model
{
    // relation with equipment 

    public function equipement()
    {
        return $this->hasMany('App\Equipment');
    }

    // relation with car assign 

    public function car_assign()
    {
        return $this->hasMany('App\CarAssign');
    }
    
    // relation with projectClaim 
    
    public function project_claim()
    {
      return $this->hasMany('App\ProjectClaim');
    }

    public function equipement_expense()
    {
      return $this->hasMany('App\EquipementExpense');
    }

    public function operator_fooding(){

        return $this->hasMany('App\OperatorFooding');
    }
}
