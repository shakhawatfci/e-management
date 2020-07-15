<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Operator;
use App\Vendor;
use App\EquipmentType;
use App\Equipement;

class OperatorController extends Controller
{
    public function index()
    {
        $vendor = Vendor::all();
        $equipment_type = EquipmentType::all();
        $equipement = Equipement::all();
    	return view('operator.operator',[
            'vendors' => $vendor,
            'equipment_types' => $equipment_type
        ]);
    }

    public function operatorList(Request $request)
    {
        $operator = Operator::with(['vendor','equipment_type','equipement'])
                              ->orderBy('id','desc');
        $keyword = $request->keyword;

        if($request->operator_type != '')
        {
            $operator->where('operator_type','=',$request->operator_type);
        }

        if($request->equipment_type_id != '')
        {
            $operator->where('equipment_type_id','=',$request->equipment_type_id);
        }

        if($request->vendor_id != '')
        {
            $operator->where('vendor_id','=',$request->vendor_id);
        }

        if($request->equipment_id != '')
        {
            $operator->where('equipement_id','=',$request->equipment_id);
        }

        if($keyword != '') {
            $operator->where(function($query) use($keyword) {
                $query->where('name','LIKE','%'.$request->keyword.'%');
                $query->orWhere('mobile','LIKE','%'.$request->keyword.'%');
                $query->orWhere('email','LIKE','%'.$request->keyword.'%');
                $query->orWhere('salary','LIKE','%'.$request->keyword.'%');
                $query->orWhere('nid','LIKE','%'.$request->keyword.'%');
            });
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
            'salary'        => 'required',
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
            	'name'			    =>    $request->operator_name,
                'equipment_type_id' =>    $request->equipment_type_id,
                'vendor_id'         =>    $request->vendor_id,
                'equipement_id'     =>    $request->equipement_id,
                'operator_type'     =>    $request->operator_type,
		        'mobile' 		    =>    $request->mobile,
		        'address' 		    =>    $request->address,
		        'email' 		    =>    $request->email,
		        'bkash_number' 	    =>    $request->bkash,
		        'join_date' 	    =>    $request->join_date,
		        'nid' 			    =>    $request->nid,
		        'date_of_birth'     =>    $request->date_of_birth,
		        'file' 			    =>    $filename,
		        'documents_link'    =>    $request->documents_link,
		        'salary' 		    =>    $request->salary,
		        'status' 		    =>        $status
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
            'name'          => 'required'
        ]);

        try {
           $status = $request->status ? 1 : 0;

            $update = Operator::find($id);
                $update->name           = $request->name;
                $update->vendor_id = $request->vendor_id;
                $update->equipment_type_id = $request->equipment_type_id;
                $update->equipement_id   = $request->equipement_id;
                $update->operator_type  = $request->operator_type;
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
