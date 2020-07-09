<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EquipmentSales extends Model
{
   
    public function equipment_type()
    {
        return $this->belongsTo('App\EquipmentType')->withDefault([
            'id' => 0,
            'name' => 'N/A'
        ]);
    }

    // relation with user 

    public function user()
    {
        return $this->belongsTo('App\User')->withDefault([
            'id' => 0,
            'name' => 'Deleted user'
        ]);
    }
}
