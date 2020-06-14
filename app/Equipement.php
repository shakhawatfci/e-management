<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipement extends Model
{
    protected $table='equipement';


    // relation with vendor 

    public function vendor()
    {
    	return $this->belongsTo('App\Vendor');
    }

    // relation with car assign 
    
    public function assign(){
      
      return $this->hasMany('App\CarAssign','equipement_id');
    }

      // relation with vendor claim 

    public function vendor_claim(){

        return $this->hasMany('App\VendorClaim','equipement_id');
    }     


     // relation with vendor payment 

    public function vendor_payment(){

        return $this->hasMany('App\VendorExpense','equipement_id');
    }


     // relation with Project claim 

    public function project_claim(){

        return $this->hasMany('App\ProjectClaim','equipement_id');
    }

     // relation with Project income 

    public function project_income(){

        return $this->hasMany('App\ProjectIncome','equipement_id');
    }
     

     // relation with Equipemtn expense

    public function equipement_expense(){

        return $this->hasMany('App\EquipementExpense','equipement_id');
    }



}
