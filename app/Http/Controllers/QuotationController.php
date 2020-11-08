<?php

namespace App\Http\Controllers;

use App\Quotation;
use App\QuotationHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PDF;
use Throwable;

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
            'to'                                             => 'required',
            'company'                                        => 'required',
            'address'                                        => 'required',
            'subject'                                        => 'required',
            'request_text'                                   => 'required',
            'terms'                                          => 'required',
            'name'                                           => 'required',
            'designation'                                    => 'required',
            'quotation_history.*.equipment_description'      => 'required',
            'quotation_history.*.equipment_rate'             => 'required|gt:0|regex:/^[0-9]+(\.[0-9]{1,10})?$/',
            'quotation_history.*.equipment_unit'             => 'required',
            'quotation_history.*.equipment_qty'              => 'required|gt:0|integer',
            'quotation_history.*.operator_description'       => 'required',
            'quotation_history.*.operator_rate'              => 'required|gt:0|regex:/^[0-9]+(\.[0-9]{1,10})?$/',
            'quotation_history.*.operator_unit'              => 'required',
            'quotation_history.*.operator_qty'               => 'required|gt:0|integer',
            'quotation_history.*.mobilization_description'   => 'required',
            'quotation_history.*.demobilization_description' => 'required',
            'quotation_history.*.mobilization_amount'        => 'required',
            'quotation_history.*.demobilization_amount'      => 'required',
        ], [
            'to.required'                                        => 'required',
            'quotation_history.*.equipment_description.required' => 'Required',
            'quotation_history.*.equipment_rate.required'        => 'Required',
            'quotation_history.*.equipment_rate.gt'              => 'Provide Non Zero',
            'quotation_history.*.equipment_rate.regex'           => 'Invalid',
            'quotation_history.*.equipment_qty.required'         => 'Reuired',
            'quotation_history.*.equipment_qty.integer'          => 'Invalid',
            'quotation_history.*.operator_description.required'  => 'Required',
            'quotation_history.*.operator_rate.required'         => 'Required',
            'quotation_history.*.operator_rate.gt'               => 'Provide Non Zero',
            'quotation_history.*.operator_rate.regex'            => 'Invalid',
            'quotation_history.*.operator_qty.required'          => 'Reuired',
            'quotation_history.*.operator_qty.integer'           => 'Invalid',
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

            foreach ($request->quotation_history as $value) {
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

    public function printQoutation($id)
    {

        $qoutation = Quotation::with(['quotation_history'])->find($id);

        $pdf = PDF::loadView('quotation.pdf', ['qoutation' => $qoutation]);

        $pdf->setPaper('A4', 'potrait');
        $pdf_name = "LIMMEX-" . date('y') . '-' . $qoutation->id . '.pdf';
        return $pdf->download($pdf_name);

        return view('quotation.print', ['qoutation' => $qoutation]);
    }

    public function sendEmail(Request $request, $id)
    {
        $request->validate([
            'to'         => 'required|email',
            'subject'    => 'required',
            'email_body' => 'required',
        ]);

        $qoutation = Quotation::with(['quotation_history'])->find($id);

        $data["to"]          = $request->to;
        $data["from"]        = "limmexbd@gmail.com";
        $data["client_name"] = $qoutation->company;
        $data["subject"]     = $request->subject;
        $data["email_body"]  = $request->email_body;
        $data["cc"]          = [];

        if ($request->cc != '') {
            $data["cc"] = explode(',', $request->cc);
        }

        $pdf = PDF::loadView('quotation.pdf', ['qoutation' => $qoutation]);
        $pdf->setPaper('A4', 'potrait');

        $data["pdf_name"] = "LIMMEX-" . date('y') . '-' . $qoutation->id . '.pdf';

        try {
            Mail::send('email.quotation', ['data' => $data], function ($message) use ($data, $pdf) {
                $message->to($data["to"], $data["client_name"])
                    ->subject($data["subject"])
                    ->from($data["from"]);
                if (count($data['cc'])) {

                    $message->cc($data['cc']);
                }
                $message->attachData($pdf->output(), $data['pdf_name']);
            });
        } catch (Throwable $exception) {
            return $exception;
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()]);
        }
        if (Mail::failures()) {

            return response()->json(['status' => 'error', 'message' => 'Mail Failed']);

        } else {

            return response()->json(['status' => 'success', 'message' => 'Mail Sended']);
        }
        return response()->json(compact('this'));
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
