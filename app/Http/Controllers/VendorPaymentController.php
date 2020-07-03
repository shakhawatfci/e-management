<?php

namespace App\Http\Controllers;

use App\VendorPayment;
use App\ProjectClaim;
use Illuminate\Http\Request;
use Auth;
use DB;

class VendorPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
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
            'payment_amount' => 'gt:0|regex:/^[0-9]+(\.[0-9]{1,10})?$/',
            'adjustment' => 'nullable|regex:/^[0-9]+(\.[0-9]{1,10})?$/'
        ]);
        
        try
        {

          $bill = ProjectClaim::find($request->id);
          
          $payment = new VendorPayment;
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


          $bill->vendor_payment += $request->vendor_amount;
          $bill->vendor_adjustment_payment += $request->adjustment;

          if($request->current_outstanding <= 0 )
          {
            //   if outstanding clear then it's paid 
           $bill->vendor_payment_status = 1;

          }

          $bill->update();

          return response()->json(['status' => 'success' , 'message' => 'Vendor Payment  Successfull']);

          
        }
        catch(\Exception $e)
        {
            return response()->json(['status' => 'error' , 'message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VendorPayment  $vendorPayment
     * @return \Illuminate\Http\Response
     */
    public function show($bill_id)
    {
        $vendor_payment = VendorPayment::with('user')
                                         ->where('project_claim_id','=',$bill_id)
                                         ->get();
          
        return $vendor_payment;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VendorPayment  $vendorPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(VendorPayment $vendorPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VendorPayment  $vendorPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VendorPayment $vendorPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VendorPayment  $vendorPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(VendorPayment $vendorPayment)
    {
      try
      {
        
        DB::beginTransaction();

        // update project claim table before deleted 

        $bill = ProjectClaim::find($vendorPayment->project_claim_id);
        $bill->vendor_payment -= $vendorPayment->amount;
        if($bill->vendor_payment+$bill->vendor_adjustment_payment >= $bill->total_vendor_amount)
        {
        $bill->vendor_payment_status == 1;
        } 
        $bill->update();

        // now delete this shit 
        $vendorPayment->delete();

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
