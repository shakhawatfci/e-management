<?php

namespace App\Http\Controllers;

use App\ProjectPayment;
use App\ProjectClaim;
use Auth;
use DB;
use Illuminate\Http\Request;

class ProjectPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
  
        $request->validate([
            'date' => 'required',
            'month' => 'required',
            'payment_amount' => 'gt:0|regex:/^[0-9]+(\.[0-9]{1,10})?$/'
        ]);
        
        try
        {

          $bill = ProjectClaim::find($request->id);
          
          $payment = new ProjectPayment;
          $payment->project_claim_id = $request->id;
          $payment->project_id = $bill->project_id; 
          $payment->equipement_id = $bill->equipement_id; 
          $payment->vendor_id = $bill->vendor_id; 
          $payment->equipment_type_id = $bill->equipment_type_id; 
          $payment->amount = $request->payment_amount; 
          $payment->date = $request->date; 
          $payment->month = $request->month;  
          $payment->note =  $request->notes; 
          $payment->user_id =  Auth::user()->id; 
          $payment->status =  1; 
          $payment->save();

          $bill->project_payment += $request->payment_amount;
          $bill->project_adjustment_payment += $request->adjustment;

          if($request->current_outstanding <= 0 )
          {
            //   if outstanding clear then it's paid 
           $bill->payment_status = 1;

          }

          $bill->update();

          return response()->json(['status' => 'success' , 'message' => 'Payment Success']);

          
        }
        catch(\Exception $e)
        {
            return response()->json(['status' => 'error' , 'message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProjectPayment  $projectPayment
     * @return \Illuminate\Http\Response
     */
    public function show($bill_id)
    {

        // finding all payment under a bill 
        $project_payment = ProjectPayment::with('user:id,name')->where('project_claim_id','=',$bill_id)
        ->get();

        return $project_payment;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProjectPayment  $projectPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectPayment $projectPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProjectPayment  $projectPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectPayment $projectPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProjectPayment  $projectPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectPayment $projectPayment)
    {
    try
      {
        
        DB::beginTransaction();

        // update project claim table before deleted 

        $bill = ProjectClaim::find($projectPayment->project_claim_id);
        $bill->project_payment -= $projectPayment->amount;
        if($bill->project_payment+$bill->project_adjustment_payment >= $bill->total_project_amount)
        {
        $bill->project_payment_status == 1;
        } 
        $bill->update();

        // now delete this shit 
        $projectPayment->delete();

        DB::commit();

        return response()->json(['status'=>'success','message' => 'Vendor Payment Deleted']);

      }
      catch(\Exception $e)
      {   
          DB::rollback();
          return response()->json(['status'=>'error','message'=>$e->getMessage()]);
      }
    }
}
