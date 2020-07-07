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


    // relation with equipement 

    public function equipment_type(){
      
      return $this->belongsTo('App\EquipmentType');

    }

    // relation with bill 

    public function car_assign(){

        return $this->belongsTo('App\CarAssign','assign_id')->withDefault([
          'id' => 0,
          'equipment_id' => 0,
          'project_id' => 0,
          'vendor_id' => 0, 
          'equipment_type_id' => 0, 
        ]
        );
    }

    // relation with user table 

    public function user()
    {
      return $this->belongsTo('App\User')->withDefault([
        'id' => 0,
        'name' => 'Deleted User',
      ]);
    }
}
