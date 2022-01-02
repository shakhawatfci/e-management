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

    public function project_claim()
    {
        return $this->belongsTo('App\ProjectClaim');
    }
}
