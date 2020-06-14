<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table='vendor';


    // relation with equipement 

    public function equipement(){
      
      return $this->hasMany('App\Equipement','vendor_id');
    } 

    // relation with project assignment 

    public function assign(){
      
      return $this->hasMany('App\CarAssign','vendor_id');
    }

    // relation with vendor claim 

    public function vendor_claim(){

    	return $this->hasMany('App\VendorClaim','vendor_id');
    }

    // relation with vendor payment 

    public function vendor_payment(){

        return $this->hasMany('App\VendorExpense','vendor_id');
    }
         // relation with Project claim 

    public function project_claim(){

        return $this->hasMany('App\ProjectClaim','vendor_id');
    }

     // relation with Project income 

    public function project_income(){

        return $this->hasMany('App\ProjectIncome','vendor_id');
    }

         // relation with Equipemtn expense

    public function equipement_expense(){

        return $this->hasMany('App\EquipementExpense','vendor_id');
    }
}
