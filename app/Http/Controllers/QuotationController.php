<?php

namespace App\Http\Controllers;

use App\Quotation;
use App\QuotationHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('quotation.quotation');
    }

    public function quotationList(Request $request)
    {

        $keyword   = $request->keyword;
        $quotation = Quotation::with(['quotation_history'])->withCount('quotation_history as total_equipment')->orderBy('updated_at', 'desc');

        if ($keyword) {
            $quotation->where(function ($query) use ($keyword) {
                $query->where('id', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('to', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('company', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('address', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('subject', 'LIKE', '%' . $keyword . '%');
            });
        }
        if ($request->no_paginate) {
            $quotation = $quotation->get();
        } else {
            $quotation = $quotation->paginate(10);
        }

        return $quotation;

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
        //
        $request->validate([
            'to'                                   => 'required',
            'company'                              => 'required',
            'address'                              => 'required',
            'subject'                              => 'required',
            'request_text'                         => 'required',
            'terms'                                => 'required',
            'name'                                 => 'required',
            'designation'                          => 'required',
            'history.*.equipment_description'      => 'required',
            'history.*.equipment_rate'             => 'required|gt:0|regex:/^[0-9]+(\.[0-9]{1,10})?$/',
            'history.*.equipment_unit'             => 'required',
            'history.*.equipment_qty'              => 'required|gt:0|integer',
            'history.*.operator_description'       => 'required',
            'history.*.operator_rate'              => 'required|gt:0|regex:/^[0-9]+(\.[0-9]{1,10})?$/',
            'history.*.operator_unit'              => 'required',
            'history.*.operator_qty'               => 'required|gt:0|integer',
            'history.*.mobilization_description'   => 'required',
            'history.*.demobilization_description' => 'required',
            'history.*.mobilization_amount'        => 'required',
            'history.*.demobilization_amount'      => 'required',
        ], [
            'to.required'                              => 'required',
            'history.*.equipment_description.required' => 'Required',
            'history.*.equipment_rate.required'        => 'Required',
            'history.*.equipment_rate.gt'              => 'Provide Non Zero',
            'history.*.equipment_rate.regex'           => 'Invalid',
            'history.*.equipment_qty.required'         => 'Reuired',
            'history.*.equipment_qty.integer'          => 'Invalid',
            'history.*.operator_description.required'  => 'Required',
            'history.*.operator_rate.required'         => 'Required',
            'history.*.operator_rate.gt'               => 'Provide Non Zero',
            'history.*.operator_rate.regex'            => 'Invalid',
            'history.*.operator_qty.required'          => 'Reuired',
            'history.*.operator_qty.integer'           => 'Invalid',
        ]);

        try {
            DB::beginTransaction();
            $quotation               = new Quotation;
            $quotation->to           = $request->to;
            $quotation->date         = date('Y-m-d');
            $quotation->company      = $request->company;
            $quotation->address      = $request->address;
            $quotation->subject      = $request->subject;
            $quotation->request_text = $request->request_text;
            $quotation->terms        = $request->terms;
            $quotation->name         = $request->name;
            $quotation->designation  = $request->designation;
            $quotation->save();

            foreach ($request->history as $value) {
                $history                             = new QuotationHistory;
                $history->equipment_description      = $value['equipment_description'];
                $history->equipment_rate             = $value['equipment_rate'];
                $history->equipment_unit             = $value['equipment_unit'];
                $history->equipment_qty              = $value['equipment_qty'];
                $history->total_equipment_amount     = $value['total_equipment_amount'];
                $history->operator_description       = $value['operator_description'];
                $history->operator_rate              = $value['operator_rate'];
                $history->operator_unit              = $value['operator_unit'];
                $history->operator_qty               = $value['operator_qty'];
                $history->total_operator_amount      = $value['total_operator_amount'];
                $history->mobilization_description   = $value['mobilization_description'];
                $history->demobilization_description = $value['demobilization_description'];
                $history->mobilization_amount        = $value['mobilization_amount'];
                $history->demobilization_amount      = $value['demobilization_amount'];
                $history->quotation_id               = $quotation->id;
                $history->save();
            }
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Qoutation Created']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th;
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function show(Quotation $quotation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function edit(Quotation $quotation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quotation $quotation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quotation $quotation)
    {
        try {
            //code...
            DB::beginTransaction();
            QuotationHistory::where('quotation_id', $quotation->id)->delete();
            $quotation->delete();
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Quotation Deleted']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }
}
