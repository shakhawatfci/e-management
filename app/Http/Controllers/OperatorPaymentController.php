<?php

namespace App\Http\Controllers;

use App\OperatorPayment;
use Illuminate\Http\Request;
use App\ProjectClaim;
use Auth,DB;

class OperatorPaymentController extends Controller
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
            'payment_amount' => 'gt:0|regex:/^[0-9]+(\.[0-9]{1,20})?$/',
            'adjustment' => 'nullable|regex:/^[0-9]+(\.[0-9]{1,20})?$/'
        ]);
        
        try
        {
            DB::beginTransaction();

          $bill = ProjectClaim::find($request->id);
          
          $payment = new OperatorPayment();
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


          $bill->operator_payment += $request->payment_amount;
          $bill->operator_adjustment_payment += $request->adjustment;

          if($request->current_outstanding <= 0 )
          {
            //   if outstanding clear then it's paid 
           $bill->operator_payment_status = 1;

          }

          $bill->update();

          DB::commit();

          return response()->json(['status' => 'success' , 'message' => 'Operator Payment  Successfull']);

          
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return response()->json(['status' => 'error' , 'message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OperatorPayment  $operatorPayment
     * @return \Illuminate\Http\Response
     */
    public function show($bill_id)
    {
        $operator_payment = OperatorPayment::with('user')
                             ->where('project_claim_id','=',$bill_id)
                             ->get();
          
        return $operator_payment;
    }

    public function operatorPaymentPrint(Request $request)
    {

        $operator_payment = ProjectClaim::with(['operator_pay','operator:id,name','equipement:id,eq_name','project:id,project_name'])->find($request->bill_id);

        if ($request->action == 'print') {
            return view('bill.print.operator_payment_print', [
                'bill'      => $operator_payment
            ]);
        } else {
            // return $pdf = view('bill.pdf.bill_pdf', [
            //     'bill'      => $bill,
            //     'form_data' => $request->all(),
            // ]);
            $pdf = PDF::loadView('bill.pdf.operator_payment_pdf', [
                'bill'      => $operator_payment,
            ]);

            $pdf->setPaper('A4', 'potrait');
            $pdf_name = "bill-" . $operator_payment->bill_no . ".pdf";
            return $pdf->download($pdf_name);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OperatorPayment  $operatorPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(OperatorPayment $operatorPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OperatorPayment  $operatorPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OperatorPayment $operatorPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OperatorPayment  $operatorPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(OperatorPayment $operatorPayment)
    {
        try
        {
            
            DB::beginTransaction();

            // update project claim table before deleted 

            $bill = ProjectClaim::find($operatorPayment->project_claim_id);
            $bill->operator_payment -= $operatorPayment->amount;
            if($bill->operator_payment+$bill->operator_adjustment_payment >= $bill->operator_total_amount)
            {
            $bill->operator_payment_status == 1;
            } 
            $bill->update();

            // now delete this shit 
            $operatorPayment->delete();

            DB::commit();

            return response()->json(['status'=>'success','message' => 'Operator Payment Deleted']);

        }
        catch(\Exception $e)
        {   
            DB::rollback();
            return response()->json(['status'=>'error','message'=>$e->getMessage()]);
        }
    }
}
