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


}
