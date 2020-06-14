<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorExpense extends Model
{
    protected $table='vendor_expense';

    // relation whith project 

    public function project(){

    	return $this->belongsTo('App\Project');
    }  

    // relation whith vendor 

    public function vendor(){

    	return $this->belongsTo('App\Vendor');
    }    

    // relation whith equipement 

    public function equipement(){

    	return $this->belongsTo('App\Equipement');
    }
}
