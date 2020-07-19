<?php

namespace App\Http\Controllers\ExpenseHeads;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\OfficeExpenseHead;
use PDF;

class OfficeExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('expense_heads.office_expense_heads');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function officeHeadList(Request $request)
    {
        $office = OfficeExpenseHead::orderBy('id','desc');
        if($request->keyword != '') {
            $office->where('head_name','LIKE','%'.$request->keyword.'%');
        }
        return $office->paginate(10);
    }

    public function officeHeadListPrint(Request $request)
    {
        $office = OfficeExpenseHead::orderBy('id','desc');
        if($request->keyword != '') {
            $office->where('head_name','LIKE','%'.$request->keyword.'%');
        }
        $office = $office->get();

        if($request->action == 'print')
        {
            return view('expense_heads.print.office_expense_head_print',['office_heads' => $office]);
        } else {
            $pdf = \PDF::loadView('expense_heads.pdf.office_expense_head_pdf', [
            // return view('expense_heads.pdf.office_expense_head_pdf', [
                'office_heads' => $office]);

            $pdf->setPaper('A4', 'landscape');
            $pdf_name = "office-expense-category.pdf";
            return $pdf->download($pdf_name);
        }
    }

    public function officeHeadData(Request $request)
    {
        return OfficeExpenseHead::orderBy('id','desc')->get();
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
            'head_name' => 'required'
        ]);
        try {
            $status = $request->status ? 1 : 0;
            $insert = OfficeExpenseHead::insert([
                'head_name' => $request->head_name,
                'status' => $status
            ]);
            if ($insert) {
                return response()->json(['status' => 'success', 'message' => 'New Office Expense Head Created !']);
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
            'head_name' => 'required'
        ]);
        try {
            $status = $request->status ? 1 : 0;
            $update = OfficeExpenseHead::find($id);
            $update->head_name = $request->head_name;
            $update->status = $status;

            if ($update->update()) {
                return response()->json(['status' => 'success', 'message' => 'Office Expense Head Updated !']);
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
        try{
            $delete = OfficeExpenseHead::find($id);
            if($delete->delete()){
                return response()->json(['status' => 'success', 'message' => 'Office Expense Head Deleted !']);
            }else{
                return response()->json(['status' => 'error', 'message' => 'Something went wrong !']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
