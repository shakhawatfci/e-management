<?php

namespace App\Http\Controllers\Expense;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProjectExpense;
use Auth;

class ProjectExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project = \App\Project::orderBy('id','desc')->get();
        $project_heads = \App\ProjectExpenseHead::orderBy('id','desc')->get();
        return view('expense.project_expense')->with([
            'project' => $project,
            'project_heads' => $project_heads
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function projectExpenseList(Request $request)
    {
        $projects = ProjectExpense::with(['project_expense_head:id,head_name','project:id,project_name'])->orderBy('id','desc');
        if($request->project != '') {
            $projects->where('project_id','=',$request->project);
        }
        if($request->project_head != '') {
            $projects->where('project_expense_head_id','=',$request->project_head);
        }
        if($request->keyword != '') {
            $projects->where('project_id','LIKE','%'.$request->keyword.'%');
        }
        return $projects->paginate(10);
    }

    public function projectExpenseListPrint(Request $request)
    {
        $projects = ProjectExpense::with(['project_expense_head:id,head_name','project:id,project_name'])->orderBy('id','desc');
        if($request->project != '') {
            $projects->where('project_id','=',$request->project);
        }
        if($request->project_head != '') {
            $projects->where('project_expense_head_id','=',$request->project_head);
        }
        if($request->keyword != '') {
            $projects->where('project_id','LIKE','%'.$request->keyword.'%');
        }
        $project = $projects->get();

        if($request->action == 'print')
        {
            return view('expense.print.project_expense_print',['projects' => $project]);
        } else {
            // return view('expense.pdf.project_expense_pdf', [
            $pdf = PDF::loadView('expense.pdf.project_expense_pdf', [
                'projects' => $project]);

            $pdf->setPaper('A4', 'landscape');
            $pdf_name = "project_expense.pdf";
            return $pdf->download($pdf_name);
        }
    }

    public function store(Request $request)
    {

        $request->validate([
            'project_expense_head_id' => 'required',
            'project_id' => 'required',
            'month' => 'required',
            'date' => 'required',
            'amount' => 'required|numeric',
            'note' => 'required'
        ]);

        try {
           $status = $request->status ? 1 : 0;
           $filename = NULL;
            if($request->file('document')){
                $data = $request->file('document');
                $ext = $data->getClientOriginalExtension();
                $filename = time().'.'.$ext;
                $data->move('upload/',$filename);
            }
            $insert = ProjectExpense::insert([
                'project_expense_head_id' => $request->project_expense_head_id,
                'project_id' => $request->project_id,
                'user_id' => Auth::id(),
                'month' => date('Y-m',strtotime($request->month)),
                'date' => $request->date,
                'amount' => $request->amount,
                'document' => $filename,
                'document_link' => $request->document_link,
                'note' => $request->note,
                'status' => $status
            ]);
            if ($insert) {
                return response()->json(['status' => 'success', 'message' => 'New Project Expense Created !']);
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
            'project_expense_head_id' => 'required',
            'project_id' => 'required',
            'month' => 'required',
            'date' => 'required',
            'amount' => 'required|numeric',
            'note' => 'required'
        ]);

        try {
           $status = $request->status ? 1 : 0;
           
            $update = ProjectExpense::find($id);
            
            $update->project_expense_head_id = $request->project_expense_head_id;
            $update->project_id = $request->project_id;
            $update->user_id = Auth::id();
            $update->month = date('Y-m',strtotime($request->month));
            $update->date = $request->date;
            $update->amount = $request->amount;
            $update->document_link = $request->document_link;
            $update->note = $request->note;
            $update->status = $status;
         
            if ($update->update()) {
                return response()->json(['status' => 'success', 'message' => 'Project Expense Updated !']);
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
            $delete = ProjectExpense::find($id);
            
        if ($delete->delete()) {
                return response()->json(['status' => 'success', 'message' => 'Project Expense Deleted !']);
            }else{
                return response()->json(['status' => 'error', 'message' => 'Something went wrong !']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
