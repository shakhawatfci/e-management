<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Operator;

class OperatorController extends Controller
{
    public function index()
    {
    	return view('operator.operator');
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
            'mobile'        => 'required',
	        'address' 		=> 'required',
	        'join_date' 	=> 'required',
	        'nid' 			=> 'required|numeric',
	        'picture' 		=> 'image|nullable'
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
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        // return $request->all();
        $request->validate([
            'name'          => 'required',
            'mobile'        => 'required',
            'address'       => 'required',
            'join_date'     => 'required',
            'nid'           => 'required|numeric',
        ]);

        try {
           $status = $request->status ? 1 : 0;

            $update = Operator::find($id);
                $update->name           = $request->name;
                $update->mobile         = $request->mobile;
                $update->address        = $request->address;
                $update->email          = $request->email;
                $update->bkash_number   = $request->bkash_number;
                $update->join_date      = $request->join_date;
                $update->nid            = $request->nid;
                $update->date_of_birth  = $request->date_of_birth;
                $update->documents_link = $request->documents_link;
                $update->salary         = $request->salary;
                $update->status         = $status;
            
            // $imageData = $request->file('file');
            if($request->file('file')){
                if (file_exists('images/operator/'.$update->file) && !empty($update->file)) {
                   
                   unlink('images/operator/'.$update->file);
                }
                $data = $request->file('file');
                $ext = $data->getClientOriginalExtension();
                $filename = time().'.'.$ext;
                $data->move('images/operator/',$filename);
                $update->file = $filename;
            }

            if ($update->update()) {
                return response()->json(['status' => 'success', 'message' => 'Operator Updated !']);
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
            $delete = Operator::find($id);
            if (file_exists('images/operator/'.$delete->file) && !empty($delete->file)) {   
               unlink('images/operator/'.$delete->file);
            }
        if ($delete->delete()) {
                return response()->json(['status' => 'success', 'message' => 'Operator Deleted !']);
            }else{
                return response()->json(['status' => 'error', 'message' => 'Something went wrong !']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
