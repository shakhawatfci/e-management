<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
   protected $table='project';
   
   
   // relation with assign 

   public function assign(){

   	return $this->hasMany('App\CarAssign','project_id');
   }

   // relation with vendorclaim

   public function vendor_claim(){
    
    return $this->hasMany('App\VendorClaim','project_id');

   }

   // relation with vendor payment 

    public function vendor_payment(){

        return $this->hasMany('App\VendorExpense','project_id');
    }


     // relation with Project claim 

    public function project_claim(){

        return $this->hasMany('App\ProjectClaim','project_id');
    }

     // relation with Project income 

    public function project_income(){

        return $this->hasMany('App\ProjectIncome','project_id');
    }

     // relation with Equipemtn expense

    public function equipement_expense(){

        return $this->hasMany('App\EquipementExpense','project_id');
    }

    public function project_expense(){

        return $this->hasMany('App\ProjectExpense');
    }
}
