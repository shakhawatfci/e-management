<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorConcern extends Model
{
    public function user()
    {
    	return $this->belongsTo('App\User')->withDefault([
    		'id' => 0,
    		'name' => 'No User'
    	]);
    }
}
