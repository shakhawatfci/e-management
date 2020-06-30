<?php

namespace App\Http\Controllers;

use App\ProjectPayment;
use App\ProjectClaim;
use Auth;
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
          $payment->note =  $request->note; 
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
    public function show(ProjectPayment $projectPayment)
    {
        //
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
        //
    }
}
