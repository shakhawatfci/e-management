<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\OperatorSalary;
use App\Operator;
use App\AllStatic;

class OperatorSalaryController extends Controller
{
    public function index()
    {
    	$operator = Operator::all();
    	return view('operator.operator_salary',['operator_data' => $operator]);
    }

    public function operatorSalaryList(Request $request)
    {
    	$salary = OperatorSalary::with('operator:id,name')->orderBy('id','desc');
        if($request->operator != '') {
            $salary->where('operator_id','=',$request->operator);
        }
        if($request->month_filter != '') {
            $filter_month = date('Y-m',strtotime(str_replace('/','-',$request->month_filter)));
            $salary->where('month','=',$filter_month);
        }
        if($request->mode != '') {
            $salary->where('mode','=',$request->mode);
        }
        if($request->keyword != '') {
            $salary->where('payment_date','LIKE','%'.$request->keyword.'%');
            $salary->orWhere('payment_amount','LIKE','%'.$request->keyword.'%');
        }
        
        return $salary->paginate(10);
    }

    public function operatorSalaryPrint(Request $request)
    {
        $salary = OperatorSalary::with('operator:id,name')->orderBy('id','desc');
        if($request->operator != '') {
            $salary->where('operator_id','=',$request->operator);
        }
        if($request->month_filter != '') {
            $filter_month = date('Y-m',strtotime(str_replace('/','-',$request->month_filter)));
            $salary->where('month','=',$filter_month);
        }
        if($request->mode != '') {
            $salary->where('mode','=',$request->mode);
        }
        if($request->keyword != '') {
            $salary->where('payment_date','LIKE','%'.$request->keyword.'%');
            $salary->orWhere('payment_amount','LIKE','%'.$request->keyword.'%');
        }
        
        $salary = $salary->get();

        if($request->action == 'print')
        {
            return view('operator.print.operator_salary_print',['salaries' => $salary]);
        } else {
            // return view('operator.pdf.operator_salary_pdf', [
            $pdf = \PDF::loadView('operator.pdf.operator_salary_pdf', [
                'salaries' => $salary]);

            $pdf->setPaper('A4', 'landscape');
            $pdf_name = "operator_salary.pdf";
            return $pdf->download($pdf_name);
        }
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
            'operator_id' 	 => 'required',
            'month'			 => 'required',
	        'payment_date' 	 => 'required',
	        'payment_amount' => 'required|numeric',
	        'mode' 			 => 'required'
        ]);

        try {
            $fmonth = date('Y-m',strtotime(str_replace('/','-',$request->month)));
           $status = $request->status ? 1 : 0;
           $bank_note = $request->mode == 2 ? $request->bank_bkash_note : NULL;
           $bkah_note = $request->mode == 3 ? $request->bank_bkash_note : NULL;
           
           $operator =  Operator::find($request->operator_id);

        //    check operator already have payment 

            $count_salary = OperatorSalary::where('month','=',$fmonth)
                                            ->where('operator_id','=',$request->operator_id)
                                            ->count();

             if($count_salary > 0)
             { 
               return response()->json(['status'=>'error','message' => 'Salary Already Given in this month']);
             }                               

            $insert = new OperatorSalary();
        	$insert->operator_id	      =    $request->operator_id;
        	$insert->equipement_id	      =    $operator->equipement_id;
        	$insert->equipment_type_id	  =    $request->equipment_type_id;
        	$insert->vendor_id	          =    $request->vendor_id;
	        $insert->month 		          =    $fmonth;
	        $insert->payment_date 	      =    $request->payment_date;
	        $insert->payment_amount       =    $request->payment_amount;
	        $insert->mode 			      =    $request->mode;
	        $insert->bank_note 	          =    $bank_note;
	        $insert->bkash_note 	      =    $bkah_note;
	        $insert->salary_type 	      =    1;
	        $insert->status 		      =    $status;
            if($insert->save()) {
                return response()->json(['status' => 'success', 'message' => 'Operator Salary Created !']);
            }else{
                return response()->json(['status' => 'error', 'message' => 'Something went wrong !']);

            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'operator_id' 	 => 'required',
            'month'			 => 'required',
	        'payment_date' 	 => 'required',
	        'payment_amount' => 'required|numeric',
	        'mode' 			 => 'required'
        ]);

        try {
            $fmonth = date('Y-m',strtotime(str_replace('/','-',$request->month)));
           $status = $request->status ? 1 : 0;
           $bank_note = $request->mode == 2 ? $request->bank_bkash_note : NULL;
           $bkash_note = $request->mode == 3 ? $request->bank_bkash_note : NULL;

            $update = OperatorSalary::find($id);

                $update->operator_id	= $request->operator_id;
		        $update->month 			= $fmonth;
		        $update->payment_date 	= $request->payment_date;
		        $update->payment_amount	= $request->payment_amount;
		        $update->mode 			= $request->mode;
		        $update->bank_note 		= $bank_note;
		        $update->bkash_note 	= $bkash_note;
                $update->status         = $status;

            if ($update->update()) {
                return response()->json(['status' => 'success', 'message' => 'Operator Salary Updated !']);
            }else{
                return response()->json(['status' => 'error', 'message' => 'Something went wrong !']);

            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }


    public function destroy($id)
    {
        try {
            $delete = OperatorSalary::find($id);
        if($delete->delete()) {
                return response()->json(['status' => 'success', 'message' => 'Operator Salary Deleted !']);
            }else{
                return response()->json(['status' => 'error', 'message' => 'Something went wrong !']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
