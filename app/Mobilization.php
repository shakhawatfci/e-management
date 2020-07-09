<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mobilization extends Model
{
   
//    relation with user 

   public function user()
   {
       return $this->belongsTo('App\User')->withDefault([
           'id' => 0,
           'name' => 'Deleted User',
       ]);
   }


   //    relation with project 

   public function project()
   {
       return $this->belongsTo('App\Project')->withDefault([
           'id'           => 0,
           'project_name' => 'N/A',
       ]);
   }


   //    relation with vendor 

   public function vendor()
   {
       return $this->belongsTo('App\Vendor')->withDefault([
           'id'           => 0,
           'vendor_name' => 'N/A',
       ]);
   }


   //    relation with equipment_type 

   public function equipment_type()
   {
       return $this->belongsTo('App\EquipmentType')->withDefault([
           'id'           => 0,
           'name' => 'N/A',
       ]);
   }

   //    relation with equipment_type 

   public function equipement()
   {
       return $this->belongsTo('App\Equipement','equipment_id')->withDefault([
           'id'           => 0,
           'eq_name'      => 'N/A',
           'eq_model'     => 'N/A',
       ]);
   }


}
