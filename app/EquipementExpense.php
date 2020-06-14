<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EquipementExpense extends Model
{
   protected $table ='equipement_expense';


           // relation with project
  public function project(){

      return $this->belongsTo('App\Project');

    }

    // relation with vendor 

    public function vendor(){

      return $this->belongsTo('App\Vendor');

    }

    // relation with equipement

  public function equipement(){

      return $this->belongsTo('App\Equipement');

    }   

    // relation with expense Category

  public function expense_category(){

      return $this->belongsTo('App\ExpenseCategory');

    }


}
