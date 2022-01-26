<?php 
namespace App\Repository\Report;

use App\ProjectClaim;
use App\EmployeeSalary;
use App\OperatorSalary;
use App\EquipementExpense;
use App\OfficeExpense;
use App\ProjectExpense;
use App\EquipmentSales;
use App\Mobilization;
use App\OperatorPayment;
use DB;

Class Report {
  
public function getMonthlyReport($month_from,$month_to)
{
    // getting month list from two month 
    $month_list = generateMonthBetween($month_from,$month_to);

    $report_data = [];


    // total counting 
    $total_project_bill_amount      = 0;
    $total_vendor_bill_amount       = 0;
    $total_bill_profit              = 0;
    $total_mobilization_profit      = 0;
    $total_equipment_sales_profit   = 0;
    $total_profit                   = 0;
    $total_employee_salary          = 0;
    $total_operator_salary          = 0;
    $total_project_expense          = 0;
    $total_equipment_expense        = 0;
    $total_office_expense           = 0;
    $total_expense                  = 0;
    $total_net_profit               = 0;
    $total_fooding_bill_amount      = 0;
    $total_fooding_paid_amount      = 0;

    // loop month and query 
    
    foreach($month_list as $value)
    {
     
    // project bill     
    $bill = ProjectClaim::selectRaw('SUM(total_project_amount) as project_bill_amount,SUM(total_vendor_amount) as vendor_bill_amount,SUM(operator_total_amount) as operator_bill_amount')
                          ->where('month','=',$value)
                          ->first();

    $mobilization_profit    = Mobilization::where('month','=',$value)->sum('profit');                      
    $equipment_sales_profit = EquipmentSales::where('month','=',$value)->sum('profit');   
    
    // expense from db 
    $employee_salary        = EmployeeSalary::where('month','=',$value)->sum('total_salary_amount');                      
    $operator_salary        = OperatorSalary::where('month','=',$value)->sum('payment_amount');                      
    $project_expense        = ProjectExpense::where('month','=',$value)->sum('amount');                      
    $equipment_expense      = EquipementExpense::where('month','=',$value)->sum('amount');                      
    $office_expense         = OfficeExpense::where('month','=',$value)->sum('amount');                     
    $fooding_payment        = OperatorPayment::where('month','=',$value)->sum('amount');                     
    
                          

     $project_bill_amount = 0;
     $vendor_bill_amount =  0;
     $fooding_bill_amount =  0;
     $fooding_paid_amount =  0;
     $bill_profit        =  0;
     
     if($bill)
     {
       $project_bill_amount = $bill->project_bill_amount ? $bill->project_bill_amount : 0;
       $vendor_bill_amount  = $bill->vendor_bill_amount  ? $bill->vendor_bill_amount  : 0;
       $fooding_bill_amount  = $bill->operator_bill_amount  ? $bill->operator_bill_amount  : 0;
      //  $operator_paid_amount  = $bill->fooding_payment  ? $bill->fooding_payment  : 0;
       $bill_profit         = $project_bill_amount - $vendor_bill_amount;

     }

     $t_profit = $bill_profit+$mobilization_profit+$equipment_sales_profit;
     
     $t_expense = $employee_salary+$operator_salary+$project_expense+$equipment_expense+$office_expense+$fooding_bill_amount;
     
     $net_profit = $t_profit - $t_expense;
     
         // total counting 
    $total_project_bill_amount      += $project_bill_amount;
    $total_vendor_bill_amount       += $vendor_bill_amount;
    $total_bill_profit              += $bill_profit;
    $total_mobilization_profit      += $mobilization_profit;
    $total_equipment_sales_profit   += $equipment_sales_profit;
    $total_profit                   += $t_profit;
    $total_employee_salary          += $employee_salary;
    $total_operator_salary          += $operator_salary;
    $total_project_expense          += $project_expense;
    $total_equipment_expense        += $equipment_expense;
    $total_office_expense           += $office_expense;
    $total_expense                  += $t_expense;
    $total_net_profit               += $net_profit;
    $total_fooding_bill_amount     += $fooding_bill_amount;
    $total_fooding_paid_amount     += $fooding_payment;
    // $fooding_paid_amount           += $fooding_payment;

    //  getting redy report data  if any data in db then wwill push and count total 


    //  making data array    
     $report_data[] = [
      'month'                  => date('M Y',strtotime($value)),
      'project_bill_amount'    => round($project_bill_amount),
      'vendor_bill_amount'     => round($vendor_bill_amount),
      'bill_profit'            => round($bill_profit),
      'mobilization_profit'    => round($mobilization_profit),
      'equipment_sales_profit' => round($equipment_sales_profit),
      'total_profit'           => round($t_profit),
      'employee_salary'        => round($employee_salary),
      'operator_salary'        => round($operator_salary),
      'project_expense'        => round($project_expense),
      'equipment_expense'      => round($equipment_expense),
      'office_expense'         => round($office_expense),
      'total_expense'          => round($t_expense),
      'net_profit'             => round($net_profit),
      'fooding_bill_amount'   => round($fooding_bill_amount),
      'fooding_paid_amount'   => round($fooding_payment),
     ];



    }
     
    $total_sum = [
        'total_project_bill_amount'           => round($total_project_bill_amount),        
        'total_vendor_bill_amount'            => round($total_vendor_bill_amount),    
        'total_bill_profit'                   => round($total_bill_profit) ,  
        'total_mobilization_profit'           => round($total_mobilization_profit)  ,   
        'total_equipment_sales_profit'        => round($total_equipment_sales_profit),     
        'total_profit'                        => round($total_profit),     
        'total_employee_salary'               => round($total_employee_salary),     
        'total_operator_salary'               => round($total_operator_salary) ,    
        'total_project_expense'               => round($total_project_expense),     
        'total_equipment_expense'             => round($total_equipment_expense),      
        'total_office_expense'                => round($total_office_expense),     
        'total_expense'                       => round($total_expense),      
        'total_net_profit'                    => round($total_net_profit),
        'total_fooding_bill_amount'          => round($total_fooding_bill_amount),  
        'total_fooding_paid_amount'          => round($total_fooding_paid_amount)  
    ];
    return ['report_data' => $report_data,'total_sum' => $total_sum];

}


// get equipment wise report 

public function getEquipmentWiseReport($month_from,$month_to,$equipment_type_id,$vendor_id,$equipment_id)
{
      // getting month list from two month 
      $month_list = generateMonthBetween($month_from,$month_to);

      $report_data = [];
      
      // total counting 
      $total_project_bill_amount      = 0;
      $total_vendor_bill_amount       = 0;
      $total_bill_profit              = 0;
      $total_project_payment          = 0;
      $total_project_outstanding      = 0;
      $total_vendor_payment           = 0;
      $total_vendor_outstanding       = 0;
      $total_operator_salary          = 0;
      $total_equipment_expense        = 0;
      $total_expense                  = 0;
      $total_net_profit               = 0;
      $total_fooding_bill_amount      = 0;
      $total_fooding_paid_amount      = 0;
      $total_fooding_outstanding      = 0;
  
      // loop month and query 
      
      foreach($month_list as $value)
      {
       
      // project bill     
      $bill = ProjectClaim::selectRaw('SUM(total_project_amount) as project_bill_amount,
                            SUM(total_vendor_amount) as vendor_bill_amount,
                            SUM(project_payment) as project_payment,
                            SUM(vendor_payment) as vendor_payment,
                            SUM(operator_total_amount) as total_fooding_amount,
                            SUM(operator_payment) as operator_payment_amount,
                            SUM(project_adjustment_payment) as project_adjustment_payment,
                            SUM(vendor_adjustment_payment) as vendor_adjustment_payment,
                            SUM(operator_adjustment_payment) as operator_adjustment_payment')
                            ->where('month','=',$value)
                            ->where('vendor_id','=',$vendor_id)
                            ->where('equipment_type_id','=',$equipment_type_id)
                            ->where('equipement_id','=',$equipment_id)
                            ->first();
        
      // expense from db 
                            
      $operator_salary        = OperatorSalary::where('month','=',$value)
                                ->where('vendor_id','=',$vendor_id)
                                ->where('equipment_type_id','=',$equipment_type_id)
                                ->where('equipement_id','=',$equipment_id)
                                ->sum('payment_amount');                      
                     
      $equipment_expense      = EquipementExpense::where('month','=',$value)
                                ->where('vendor_id','=',$vendor_id)
                                ->where('equipment_type_id','=',$equipment_type_id)
                                ->where('equipement_id','=',$equipment_id)
                                ->sum('amount');
       $project_bill_amount   =  0;
       $vendor_bill_amount    =  0;
       $fooding_bill_amount    =  0;
       $project_payment       =  0;
       $vendor_payment        =  0;
       $fooding_payment       =  0;
       $project_outstanding   =  0;
       $vendor_outstanding    =  0;
       $bill_profit           =  0;
       $fooding_outstanding   =  0;
       $fooding_paid_amount = 0;
       
       if($bill)
       {
         $project_bill_amount = $bill->project_bill_amount ? $bill->project_bill_amount : 0;
         $vendor_bill_amount  = $bill->vendor_bill_amount  ? $bill->vendor_bill_amount  : 0;
         $fooding_bill_amount  = $bill->total_fooding_amount  ? $bill->total_fooding_amount  : 0;
         $bill_profit         = $project_bill_amount - $vendor_bill_amount;

         $project_payment     = $bill->project_payment+$bill->project_adjustment_payment;
         $vendor_payment      = $bill->vendor_payment+$bill->vendor_adjustment_payment;
         
         $fooding_payment     = $bill->operator_payment_amount+$bill->operator_adjustment_payment;

         $project_outstanding = $project_bill_amount-$project_payment;
         $vendor_outstanding  = $vendor_bill_amount-$vendor_payment;
         $fooding_outstanding  = $fooding_bill_amount-$fooding_payment;
  
       }

    //    inside loop total income and expense 

     $t_expense = $operator_salary+$equipment_expense+$fooding_paid_amount;     
     $net_profit = $bill_profit - $t_expense;
       
           // total counting 
      $total_project_bill_amount      += $project_bill_amount;
      $total_vendor_bill_amount       += $vendor_bill_amount;
      $total_bill_profit              += $bill_profit;
      $total_project_payment          += $project_payment;
      $total_project_outstanding      += $project_outstanding;
      $total_vendor_payment           += $vendor_payment;
      $total_vendor_outstanding       += $vendor_outstanding;
      $total_operator_salary          += $operator_salary;
      $total_equipment_expense        += $equipment_expense;
      $total_fooding_bill_amount      += $fooding_bill_amount;
      $total_fooding_paid_amount      += $fooding_payment;
      $total_fooding_outstanding      += $fooding_outstanding;
      $total_expense                  += $t_expense;
      $total_net_profit               += $net_profit;
  
      //  getting redy report data 
        
       $report_data[] = [
        'month'                        => date('M Y',strtotime($value)),
        'project_bill_amount'          => round($project_bill_amount),
        'vendor_bill_amount'           => round($vendor_bill_amount),
        'bill_profit'                  => round($bill_profit),
        'project_payment'              => round($project_payment),
        'vendor_payment'               => round($vendor_payment),
        'project_outstanding'          => round($project_outstanding),
        'vendor_outstanding'           => round($vendor_outstanding),
        'operator_salary'              => round($operator_salary),
        'equipment_expense'            => round($equipment_expense),
        'total_expense'                => round($t_expense),
        'fooding_bill_amount'          => round($fooding_bill_amount),
        'fooding_paid_amount'          => round($fooding_payment),
        'fooding_outstanding'          => round($fooding_outstanding),
        'net_profit'                   => round($net_profit),
       ];
      }

      $total_sum = [
          'total_project_bill_amount'           => round($total_project_bill_amount),        
          'total_vendor_bill_amount'            => round($total_vendor_bill_amount),    
          'total_bill_profit'                   => round($total_bill_profit) ,            
          'total_project_payment'               => round($total_project_payment) ,            
          'total_project_outstanding'           => round($total_project_outstanding) ,            
          'total_vendor_payment'                => round($total_vendor_payment) ,            
          'total_vendor_outstanding'            => round($total_vendor_outstanding) ,            
          'total_operator_salary'               => round($total_operator_salary) ,        
          'total_equipment_expense'             => round($total_equipment_expense),         
          'total_fooding_bill_amount'             => round($total_fooding_bill_amount),         
          'total_fooding_paid_amount'             => round($total_fooding_paid_amount),         
          'total_fooding_outstanding'             => round($total_fooding_outstanding),         
          'total_expense'                       => round($total_expense),      
          'total_net_profit'                    => round($total_net_profit)  
      ];
      return ['report_data' => $report_data,'total_sum' => $total_sum];
}


// project wise report 


public function getProjectWiseReport($month_from,$month_to,$project_id)
{
         // getting month list from two month 
         $month_list = generateMonthBetween($month_from,$month_to);

         $report_data = [];
         
         // total counting 
         $total_project_bill_amount      = 0;
         $total_vendor_bill_amount       = 0;
         $total_bill_profit              = 0;
         $total_project_payment          = 0;
         $total_project_outstanding      = 0;
         $total_vendor_payment           = 0;
         $total_vendor_outstanding       = 0;
         $total_equipment_expense        = 0;
         $total_project_expense          = 0;
         $total_expense                  = 0;
         $total_net_profit               = 0;

        $total_fooding_bill_amount      = 0;
        $total_fooding_paid_amount      = 0;
        $total_fooding_outstanding      = 0;
    
     
         // loop month and query 
         
         foreach($month_list as $value)
         {
          
         // project bill     
         $bill = ProjectClaim::selectRaw('SUM(total_project_amount) as project_bill_amount,
                               SUM(total_vendor_amount) as vendor_bill_amount,
                               SUM(project_payment) as project_payment,
                               SUM(vendor_payment) as vendor_payment,
                               SUM(operator_total_amount) as total_fooding_amount,
                                SUM(operator_payment) as operator_payment_amount,
                               SUM(project_adjustment_payment) as project_adjustment_payment,
                               SUM(vendor_adjustment_payment) as vendor_adjustment_payment,
                               SUM(operator_adjustment_payment) as fooding_adjustment_payment')
                               ->where('month','=',$value)
                               ->where('project_id','=',$project_id)
                               ->first();
                  
                        
        $project_expense      =  ProjectExpense::where('month','=',$value)
                                  ->where('project_id','=',$project_id)
                                  ->sum('amount'); 
                                  
                                  
        $equipment_expense      = EquipementExpense::where('month','=',$value)
                                  ->where('project_id','=',$project_id)
                                  ->sum('amount');

                                  
                                                     
          $project_bill_amount   =  0;
          $vendor_bill_amount    =  0;
          $fooding_bill_amount    =  0;
          $project_payment       =  0;
          $vendor_payment        =  0;
          $fooding_payment       =  0;
          $project_outstanding   =  0;
          $vendor_outstanding    =  0;
          $bill_profit           =  0;
          $fooding_paid_amount   =  0;
          $fooding_outstanding   =  0;
          
          if($bill)
          {
            $fooding_paid_amount = $bill->operator_payment_amount;
            $project_bill_amount = $bill->project_bill_amount ? $bill->project_bill_amount : 0;
            $vendor_bill_amount  = $bill->vendor_bill_amount  ? $bill->vendor_bill_amount  : 0;
            $fooding_bill_amount  = $bill->total_fooding_amount  ? $bill->total_fooding_amount  : 0;
            $bill_profit         = $project_bill_amount - $vendor_bill_amount;
   
            $project_payment     = $bill->project_payment+$bill->project_adjustment_payment;
            $vendor_payment      = $bill->vendor_payment+$bill->vendor_adjustment_payment;
            $fooding_payment     = $fooding_paid_amount + $bill->fooding_adjustment_payment;

            $project_outstanding = $project_bill_amount-$project_payment;
            $vendor_outstanding  = $vendor_bill_amount-$vendor_payment;
            $fooding_outstanding  = ($fooding_bill_amount - $fooding_payment);

     
          }
          // dd($bill);
       //    inside loop total income and expense 
   
        $t_expense = $equipment_expense+$project_expense+$fooding_paid_amount;    
        $net_profit = $bill_profit - $t_expense;
          
              // total counting 
         $total_project_bill_amount      += $project_bill_amount;
         $total_vendor_bill_amount       += $vendor_bill_amount;
         $total_bill_profit              += $bill_profit;
         $total_project_payment          += $project_payment;
         $total_project_outstanding      += $project_outstanding;
         $total_vendor_payment           += $vendor_payment;
         $total_vendor_outstanding       += $vendor_outstanding;
         $total_equipment_expense        += $equipment_expense;
         $total_project_expense          += $project_expense;
         $total_fooding_bill_amount      += $fooding_bill_amount;
         $total_fooding_paid_amount      += $fooding_paid_amount;
         $total_fooding_outstanding      += $fooding_outstanding;
         $total_expense                  += $t_expense;
         $total_net_profit               += $net_profit;
     
         //  getting redy report data 
           
          $report_data[] = [
           'month'                        => date('M Y',strtotime($value)),
           'project_bill_amount'          => round($project_bill_amount),
           'vendor_bill_amount'           => round($vendor_bill_amount),
           'bill_profit'                  => round($bill_profit),
           'project_payment'              => round($project_payment),
           'vendor_payment'               => round($vendor_payment),
           'project_outstanding'          => round($project_outstanding),
           'vendor_outstanding'           => round($vendor_outstanding),
           'equipment_expense'            => round($equipment_expense),
           'project_expense'              => round($project_expense),
           'total_expense'                => round($t_expense),
           'net_profit'                   => round($net_profit),
           'fooding_bill_amount'          => round($fooding_bill_amount),
           'fooding_paid_amount'          => round($fooding_payment),
           'fooding_outstanding'          => round($fooding_outstanding),
          ];
         }
   
         $total_sum = [
             'total_project_bill_amount'           => round($total_project_bill_amount),        
             'total_vendor_bill_amount'            => round($total_vendor_bill_amount),    
             'total_bill_profit'                   => round($total_bill_profit) ,            
             'total_project_payment'               => round($total_project_payment) ,            
             'total_project_outstanding'           => round($total_project_outstanding) ,            
             'total_vendor_payment'                => round($total_vendor_payment) ,            
             'total_vendor_outstanding'            => round($total_vendor_outstanding) ,            
             'total_equipment_expense'             => round($total_equipment_expense) ,        
             'total_project_expense'               => round($total_project_expense),  
             'total_fooding_bill_amount'           => round($total_fooding_bill_amount),         
             'total_fooding_paid_amount'           => round($total_fooding_paid_amount),         
             'total_fooding_outstanding'           => round($total_fooding_outstanding),           
             'total_expense'                       => round($total_expense),      
             'total_net_profit'                    => round($total_net_profit)  
         ];
         return ['report_data' => $report_data,'total_sum' => $total_sum];

}
}