<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OperatorFooding extends Model
{
    public function project()
    {
    	return $this->belongsTo('App\Project');
    }

    public function vendor()
    {
    	return $this->belongsTo('App\Vendor');
    }

    public function equipment_type()
    {
    	return $this->belongsTo('App\EquipmentType');
    }

    public function equipement()
    {
    	return $this->belongsTo('App\Equipement');
    }

    public function operator()
    {
    	return $this->belongsTo('App\Operator');
    }
}
