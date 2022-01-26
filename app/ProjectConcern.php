<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectConcern extends Model
{
    public function user()
    {
    	return $this->belongsTo('App\User')->withDefault([
    		'id' => 0,
    		'name' => 'No User'
    	]);
    }
}
