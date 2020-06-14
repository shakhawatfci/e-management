<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
   protected $table = 'bills';


   // relation with project_claim 

   public function project_claim(){
       
       return $this->belongsTo('App\ProjectClaim','claim_id','id');

   }


}
