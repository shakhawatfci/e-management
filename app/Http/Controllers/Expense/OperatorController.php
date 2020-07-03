<?php

namespace App\Http\Controllers\Expense;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Operator;

class OperatorController extends Controller
{
    public function index()
    {
    	return view('expense.operator');
    }

    public function operatorList(Request $request)
    {
    	$operator = Operator::orderBy('id','desc');
        if($request->keyword != '') {
            $operator->where('name','LIKE','%'.$request->keyword.'%');
            $operator->orWhere('email','LIKE','%'.$request->keyword.'%');
            $operator->orWhere('phone','LIKE','%'.$request->keyword.'%');
            $operator->orWhere('bkash_number','LIKE','%'.$request->keyword.'%');
            $operator->orWhere('nid','LIKE','%'.$request->keyword.'%');
        }
        return $operator->paginate(10);
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
            'operator_name' => 'required',
	        'mobile' 		=> 'required|numeric|min:11',
	        'address' 		=> 'required',
	        'email' 		=> 'required',
	        'bkash' 		=> 'required|numeric|min:11',
	        'join_date' 	=> 'required',
	        'nid' 			=> 'required|numeric',
	        'date_of_birth' => 'required',
	        'picture' 		=> 'image|nullable',
	        'salary' 		=> 'required|numeric'
        ]);

        try {
           $status = $request->status ? 1 : 0;
           $filename = NULL;
            if($request->file('picture')){
                $data = $request->file('picture');
                $ext = $data->getClientOriginalExtension();
                $filename = time().'.'.$ext;
                $data->move('images/operator/',$filename);
            }
            $insert = Operator::insert([
            	'name'			=> $request->operator_name,
		        'mobile' 		=> $request->mobile,
		        'address' 		=> $request->address,
		        'email' 		=> $request->email,
		        'bkash_number' 	=> $request->bkash,
		        'join_date' 	=> $request->join_date,
		        'nid' 			=> $request->nid,
		        'date_of_birth' => $request->date_of_birth,
		        'file' 			=> $filename,
		        'documents_link'=> $request->documents_link,
		        'salary' 		=> $request->salary,
		        'status' 		=> $status
            ]);
            if ($insert) {
                return response()->json(['status' => 'success', 'message' => 'New Operator Created !']);
            }else{
                return response()->json(['status' => 'error', 'message' => 'Something went wrong !']);

            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
