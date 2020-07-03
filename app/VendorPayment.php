<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorPayment extends Model
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
