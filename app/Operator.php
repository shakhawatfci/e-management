<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
   protected $table='operators';

   // relation with operator salary

   public function salary(){
    
    return $this->hasMany('App\OperatorSalary');

   }

   public function car_assign()
   {
      return $this->hasMany('App\CarAssign');
   }

   public function equipment_expense_invoice()
   {
      return $this->hasMany('App\EquipmentExpenseInvoice');
   }

   public function operator_fooding(){

        return $this->hasMany('App\OperatorFooding');
    }

    public function vendor()
    {
    	return $this->belongsTo('App\Vendor')->withDefault(
          [
             'id' => 0,
             'vendor_name' => 'N/A'
          ]
         );
    }

    public function equipment_type()
    {
    	return $this->belongsTo('App\EquipmentType')->withDefault(
         [
            'id' => 0,
            'name' => 'N/A'
         ]
      );
    }

    public function equipement()
    {
    	return $this->belongsTo('App\Equipement')->withDefault(
         [
            'id'          => 0,
            'eq_name'     => 'N/A',
            'eq_model'    => 'N/A',
            'eq_capacity' => 'N/A'
         ]
      );
    }

    public function project_claim()
    {
      return $this->hasMany('App\ProjectClaim');
    }
}
