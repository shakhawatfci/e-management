<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Operator;
use App\Vendor;
use App\EquipmentType;
use App\Equipement;
use App\Project;
use App\ProjectClaim;
use App\OperatorFooding;
use App\OperatorPayment;
use DB;

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
        $per_page = 10;

        if ($request->per_page > 0) {
            $per_page = $request->per_page;
        }

        $bill = ProjectClaim::with([
            'user:id,name',
            'equipement',
            'equipment_type',
            'vendor',
            'project',
            'operator'
        ])
        ->select('operator_id','project_id','equipement_id', DB::raw('SUM(operator_total_amount) as total_fooding_amount,
                    SUM(operator_payment) as operator_payment_amount,
                    SUM(operator_adjustment_payment) as operator_adjustment_payment'))
        ->groupBy('equipement_id')
        ->groupBy('project_id')
        ->groupBy('operator_id');

        if ($request->operator_id != '') {
            $bill->where('operator_id', '=', $request->operator_id);
        }

        if ($request->project_id != '') {
            $bill->where('project_id', '=', $request->project_id);
        }

        if ($request->equipment_id != '') {
            $bill->where('equipement_id', '=', $request->equipment_id);
        }

        if($request->no_paginate === 'yes')
        {
            $bill = $bill->get();
        } else {

            $bill = $bill->paginate($per_page);
        }
        
        return $bill;
    }

    public function operatorFoodingPayment($project_id,$equipment_id)
    {
        return OperatorPayment::with('user','project_claim')->where(['project_id' => $project_id,'equipement_id' => $equipment_id])->get();
    }

    public function operatorFoodingListPrint(Request $request)
    {
        $bill = ProjectClaim::with([
            'user:id,name',
            'equipement',
            'equipment_type',
            'vendor',
            'project',
            'operator'
        ])
        ->select('operator_id','project_id','equipement_id', DB::raw('SUM(operator_total_amount) as total_fooding_amount,
                    SUM(operator_payment) as operator_payment_amount,
                    SUM(operator_adjustment_payment) as operator_adjustment_payment'))
        ->groupBy('equipement_id')
        ->groupBy('project_id')
        ->groupBy('operator_id');

        if ($request->operator_id != '') {
            $bill->where('operator_id', '=', $request->operator_id);
        }

        if ($request->project_id != '') {
            $bill->where('project_id', '=', $request->project_id);
        }

        if ($request->equipment_id != '') {
            $bill->where('equipement_id', '=', $request->equipment_id);
        }

        $bill = $bill->get();

        if($request->action == 'print')
        {
            return view('operator.print.operator_fooding_print',[
                'foodings' => $bill,
                'request_for' => request()
            ]);
        } else {
            // return view('operator.pdf.operator_fooding_pdf', [
            $pdf = \PDF::loadView('operator.pdf.operator_fooding_pdf', [
                'foodings' => $bill,
                'request_for' => request()
            ]);

            $pdf->setPaper('A4', 'landscape');
            $pdf_name = "operator_fooding.pdf";
            return $pdf->download($pdf_name);
        }
        
    }

    public function operatorFoodingPrint(Request $request)
    {
        $month = null;
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
        if($request->keyword != '') {
            $foodings->where('month','LIKE','%'.$request->keyword.'%');
            $foodings->orWhere('date','LIKE','%'.$request->keyword.'%');
            $foodings->orWhere('fooding_amount','LIKE','%'.$request->keyword.'%');
        }
        if ($request->end_month != '' && $request->end_month != 'undefined') {
            $start = date('Y-m',strtotime(str_replace('/','-',$request->start_month)));
            $end = date('Y-m',strtotime(str_replace('/','-',$request->end_month)));

            $foodings->whereBetween('month', [$start,$end]);
            $month .= 'From ' .$start. ' to ' .$end;
        }
        $fooding = $foodings->get();

        if($request->action == 'print')
        {
            return view('operator.print.operator_fooding_print',[
                'foodings' => $fooding,
                'month' => $month
            ]);
        } else {
            // return view('operator.pdf.operator_fooding_pdf', [
            $pdf = \PDF::loadView('operator.pdf.operator_fooding_pdf', [
                'foodings' => $fooding,
                'month' => $month
            ]);

            $pdf->setPaper('A4', 'landscape');
            $pdf_name = "operator_fooding.pdf";
            return $pdf->download($pdf_name);
        }
    }

    public function operatorFoodingPaymentPrint(Request $request)
    {
        $operator_payment = $this->operatorFoodingPayment($request->project_id,$request->equipement_id);

        // dd($operator_payment);
        if ($request->action == 'print') {
            return view('operator.print.operator_fooding_payment_print', [
                'bill'      => $operator_payment
            ]);
        } else {
           
            $pdf = PDF::loadView('operator.pdf.operator_fooding_payment_pdf', [
                'bill'      => $operator_payment
            ]);

            $pdf->setPaper('A4', 'potrait');
            $pdf_name = "operator_payment-" . $operator_payment->bill_no . ".pdf";
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
                'month' => date('Y-m',strtotime(str_replace('/','-',$request->month))),
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
            $update->month = date('Y-m',strtotime(str_replace('/','-',$request->month)));
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
