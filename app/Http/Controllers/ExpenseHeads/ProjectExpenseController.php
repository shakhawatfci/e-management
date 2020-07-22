<?php

namespace App\Http\Controllers\ExpenseHeads;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProjectExpenseHead;
use PDF;

class ProjectExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('expense_heads.project_expense_heads');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function projectHeadList(Request $request)
    {
        $projects = ProjectExpenseHead::orderBy('id','desc');
        if($request->keyword != '') {
            $projects->where('head_name','LIKE','%'.$request->keyword.'%');
        }
        return $projects->paginate(10);
    }

    public function projectHeadListPrint(Request $request)
    {
        $projects = ProjectExpenseHead::orderBy('id','desc');
        if($request->keyword != '') {
            $projects->where('head_name','LIKE','%'.$request->keyword.'%');
        }
        $projects = $projects->get();

        if($request->action == 'print')
        {
            return view('expense_heads.print.project_expense_head_print',['project_heads' => $projects]);
        } else {
            $pdf = \PDF::loadView('expense_heads.pdf.project_expense_head_pdf', [
            // return view('expense_heads.pdf.project_expense_head_pdf', [
                'project_heads' => $projects]);

            $pdf->setPaper('A4', 'landscape');
            $pdf_name = "project-expense-category.pdf";
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
            'head_name' => 'required'
        ]);
        try {
            $status = $request->status ? 1 : 0;
            $insert = ProjectExpenseHead::insert([
                'head_name' => $request->head_name,
                'status' => $status
            ]);
            if ($insert) {
                return response()->json(['status' => 'success', 'message' => 'New Project Expense Head Created !']);
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
            $update = ProjectExpenseHead::find($id);
            $update->head_name = $request->head_name;
            $update->status = $status;

            if ($update->update()) {
                return response()->json(['status' => 'success', 'message' => 'Project Expense Head Updated !']);
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
            $delete = ProjectExpenseHead::find($id);
            if($delete->delete()){
                return response()->json(['status' => 'success', 'message' => 'Project Expense Head Deleted !']);
            }else{
                return response()->json(['status' => 'error', 'message' => 'Something went wrong !']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
