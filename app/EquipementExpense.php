<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EquipementExpense extends Model
{
    protected $table = 'equipement_expense';
    protected $fillable = ['invoice_no'];
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

    // relation with equipement

    public function equipement()
    {

        return $this->belongsTo('App\Equipement');

    }

    // relation with expense Category

    public function expense_category()
    {

        return $this->belongsTo('App\ExpenseCategory');

    }

    public function equipment_type()
    {

        return $this->belongsTo('App\EquipmentType');

    }

    public function equipment_expense_head()
    {

        return $this->belongsTo('App\EquipmentExpenseHead')->withDefault([
            'id'   => '',
            'head_name' => '',
        ]);

    }
    // public function equipment_expense_invoice()
    // {
    // 	return $this->belongsTo('App\EquipmentExpenseInvoice');
    // }

}
