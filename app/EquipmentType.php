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
}
