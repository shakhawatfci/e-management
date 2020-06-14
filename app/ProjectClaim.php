<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectClaim extends Model
{
    protected $table='project_claim';

    
    // relation with project 

    public function project(){

    	return $this->belongsTo('App\Project');
    }

    // relation with vendor 

    public function vendor(){
      
      return $this->belongsTo('App\Vendor');

    }   

    // relation with equipement 

    public function equipement(){
      
      return $this->belongsTo('App\Equipement');

    }

    // relation with bill 

    public function bills(){

        return $this->hasMany('App\Bill');
    }
}
