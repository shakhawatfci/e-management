<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectPayment extends Model
{
    // relation with user 

    public function user()
    {
        return $this->belongsTo('App\User')->withDefault(
            [
                'id' => 0,
                'name' => 'deleted User',
            ]
        );
    }
}
