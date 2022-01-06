<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EquipmentExpenseInvoice extends Model
{
    protected $table = 'equipment_expense_invoices';

    // relation with project
    public function project()
    {

        return $this->belongsTo('App\Project');

    }

    // relation with vendor

    public function vendor()
    {

        return $this->belongsTo('App\Vendor')->withDefault([
            'id'   => '',
            'name' => '',
        ]);

    }

    // relation with operator

    public function operator()
    {

        return $this->belongsTo('App\Operator')->withDefault([
            'id' => 0,
            'name' => 'NF',
        ]);

    }

    // relation with equipement

    public function equipement()
    {

        return $this->belongsTo('App\Equipement');

    }

    public function equipment_type()
    {
        return $this->belongsTo('App\EquipmentType');
    }

    public function equipment_expense_head()
    {
        return $this->belongsTo('App\EquipmentExpenseHead');
    }

    public function equipment_expense()
    {
        return $this->hasMany('App\EquipementExpense');
    }
}
