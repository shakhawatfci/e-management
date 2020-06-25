<?php


function generateBillNo($month)
{
  //   bill format will be year-month-bill_no as like 2020-06-11 
  //   getting last bill by this month
    $last_bill = DB::table('project_claim')
                     ->where('month',$month)
                     ->first();
    //  default bill number will be first bill of this month 
    $bill_no = $month.'-'.'1';
    // if there is bill in this month we will add 1 with that number                  
     if($last_bill)
     {
        $explode =  explode('-',$last_bill->bill_no);
        
        // if last bill is 2 now will be plus one 2+1 = 3 
        $plus_one = $explode[2]+1;
        $bill_no =  $month.'-'.$plus_one;
     }
     
    //  :) finally returning the bill number  
    return $bill_no; 

}