<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OperatorPayment extends Model
{
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
