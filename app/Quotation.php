<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    //

    // realation with qutation history

    public function quotation_history()
    {
        return $this->hasMany(QuotationHistory::class);
    }
}
