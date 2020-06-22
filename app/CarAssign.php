<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarAssign extends Model
{
    protected $table='car_assign';

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

  // relation with equipment type 

  public function equipment_type()
  {
    return $this->belongsTo('App\EquipmentType')->withDefault(
      [
        'id'   =>  0,
        'name' =>  'N/A',
      ]
    );
  }

  // relation with operator 

  public function operator()
  {
      return $this->belongsTo('App\Operator')->withDefault([
        'id' => 0,
        'name' => 'N/A',
      ]);
   }

  //  relation with user 

  public function user()
  {
    return $this->belongsTo('App\User')->withDefault([
      'id'   => 0,
      'name' => 'N/A'
    ]);
  }

  //  relation with project claim 

  public function project_claim()
  {
    return $this->hasMany('App\ProjectClaim','assign_id');
  }
  


}
