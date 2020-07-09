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
        if($request->keyword != '') {
            $salary->where('payment_date','LIKE','%'.$request->keyword.'%');
            $salary->orWhere('month','LIKE','%'.$request->keyword.'%');
            $salary->orWhere('payment_amount','LIKE','%'.$request->keyword.'%');
            $salary->orWhere('salary_type','LIKE','%'.$request->keyword.'%');
        }
        return $salary->paginate(10);
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
	        'mode' 			 => 'required',
	        'salary_type' 	 => 'required'
        ]);

        try {
           $status = $request->status ? 1 : 0;

            $insert = OperatorSalary::insert([
            	'operator_id'	=> $request->operator_id,
		        'month' 		=> $request->month,
		        'payment_date' 	=> $request->payment_date,
		        'payment_amount'=> $request->payment_amount,
		        'mode' 			=> $request->mode,
		        'bank_note' 	=> $request->bank_note,
		        'bkash_note' 	=> $request->bkash_note,
		        'salary_type' 	=> $request->salary_type,
		        'status' 		=> $status
            ]);
            if ($insert) {
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
	        'mode' 			 => 'required',
	        'salary_type' 	 => 'required'
        ]);

        try {
           $status = $request->status ? 1 : 0;

            $update = OperatorSalary::find($id);
                $update->operator_id	= $request->operator_id;
		        $update->month 			= $request->month;
		        $update->payment_date 	= $request->payment_date;
		        $update->payment_amount	= $request->payment_amount;
		        $update->mode 			= $request->mode;
		        $update->bank_note 		= $request->bank_note;
		        $update->bkash_note 	= $request->bkash_note;
		        $update->salary_type 	= $request->salary_type;
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
