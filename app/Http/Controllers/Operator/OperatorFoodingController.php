<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Operator;
use App\Vendor;
use App\EquipmentType;
use App\Equipement;
use App\Project;
use App\OperatorFooding;

class OperatorFoodingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $operator = Operator::all();
        $vendor = Vendor::all();
        $equipment_type = EquipmentType::all();
        $equipement = Equipement::all();
        $project = Project::all();

        return view('operator.operator_fooding',[
            'operators' => $operator,
            'vendors' => $vendor,
            'equipment_types' => $equipment_type,
            'equipements' => $equipement,
            'projects' => $project
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function operatorFoodingList(Request $request)
    {
        $foodings = OperatorFooding::with(['project:id,project_name','vendor:id,vendor_name','equipment_type:id,name','equipement:id,eq_name','operator:id,name'])->orderBy('id','desc');
        if($request->project != '') {
            $foodings->where('project_id','=',$request->project);
        }
        if($request->vendor != '') {
            $foodings->where('vendor_id','=',$request->vendor);
        }
        if($request->equipment_type != '') {
            $foodings->where('equipment_type_id','=',$request->equipment_type);
        }
        if($request->equipement != '') {
            $foodings->where('equipement_id','=',$request->equipement);
        }
        if($request->operator != '') {
            $foodings->where('operator_id','=',$request->operator);
        }
        if($request->month_filter != '') {
            // return  $request->month_filter;
            $filter_month = date('Y-m',strtotime(str_replace('/','-',$request->month_filter)));
            // return $filter_month;
            $foodings->where('month','=',$filter_month);
        }
        return $foodings->paginate(10);
    }

    public function operatorFoodingPrint(Request $request)
    {
        $foodings = OperatorFooding::with(['project:id,project_name','vendor:id,vendor_name','equipment_type:id,name','equipement:id,eq_name','operator:id,name'])->orderBy('id','desc');
        if($request->project != '') {
            $foodings->where('project_id','=',$request->project);
        }
        if($request->vendor != '') {
            $foodings->where('vendor_id','=',$request->vendor);
        }
        if($request->equipment_type != '') {
            $foodings->where('equipment_type_id','=',$request->equipment_type);
        }
        if($request->equipement != '') {
            $foodings->where('equipement_id','=',$request->equipement);
        }
        if($request->operator != '') {
            $foodings->where('operator_id','=',$request->operator);
        }
        if($request->month_filter != '') {
            // return  $request->month_filter;
            $filter_month = date('Y-m',strtotime(str_replace('/','-',$request->month_filter)));
            // return $filter_month;
            $foodings->where('month','=',$filter_month);
        }
        $fooding = $foodings->get();

        if($request->action == 'print')
        {
            return view('operator.print.operator_fooding_print',['foodings' => $fooding]);
        } else {
            // return view('operator.pdf.operator_fooding_pdf', [
            $pdf = \PDF::loadView('operator.pdf.operator_fooding_pdf', [
                'foodings' => $fooding]);

            $pdf->setPaper('A4', 'landscape');
            $pdf_name = "operator_fooding.pdf";
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
            'month' => 'required',
            'date' => 'required',
            'operator_id' => 'required',
            'fooding_amount' => 'required|numeric'
        ]);

        try {
           $status = $request->status ? 1 : 0;

            $insert = OperatorFooding::insert([
                'project_id' => $request->project_id,
                'vendor_id' => $request->vendor_id,
                'equipment_type_id' => $request->equipment_type_id,
                'equipement_id' => $request->equipement_id,
                'operator_id'  => $request->operator_id,
                'fooding_amount' => $request->fooding_amount,
                'month' => date('Y-m',strtotime($request->month)),
                'date' => $request->date,
                'status'       => $status
            ]);
            if ($insert) {
                return response()->json(['status' => 'success', 'message' => 'New Operator Fooding Created !']);
            }else{
                return response()->json(['status' => 'error', 'message' => 'Something went wrong !']);

            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'month' => 'required',
            'date' => 'required',
            'operator_id' => 'required',
            'fooding_amount' => 'required|numeric'
        ]);

        try {
           $status = $request->status ? 1 : 0;

            $update = OperatorFooding::find($id);
            $update->project_id = $request->project_id;
            $update->vendor_id = $request->vendor_id;
            $update->equipment_type_id = $request->equipment_type_id;
            $update->equipement_id = $request->equipement_id;
            $update->operator_id  = $request->operator_id;
            $update->fooding_amount = $request->fooding_amount;
            $update->date = $request->date;
            $update->month = date('Y-m',strtotime($request->month));
            $update->status       = $status;

            if($update->update()) {
                return response()->json(['status' => 'success', 'message' => 'Operator Fooding Updated !']);
            }else{
                return response()->json(['status' => 'error', 'message' => 'Something went wrong !']);

            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $delete = OperatorFooding::find($id);
        if ($delete->delete()) {
                return response()->json(['status' => 'success', 'message' => 'Operator Fooding Deleted !']);
            }else{
                return response()->json(['status' => 'error', 'message' => 'Something went wrong !']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
