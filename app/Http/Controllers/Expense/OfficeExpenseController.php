<?php

namespace App\Http\Controllers\Expense;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\OfficeExpense;
use App\AllStatic;
use App\OfficeExpenseHead;
use Auth;

class OfficeExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $office_heads = OfficeExpenseHead::orderBy('head_name','asc')
                ->where('status','=',AllStatic::$active)->get();

        return view('expense.office_expense',['office_head' => $office_heads]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function officeExpenseList(Request $request)
    {
        // 
        $office = OfficeExpense::with(['office_expense_head:id,head_name'])->orderBy('id','desc');
        if($request->office_head != '') {
            $office->where('office_expense_head_id','=',$request->office_head);
        }
        if($request->keyword != '') {
            $office->where('project_id','LIKE','%'.$request->keyword.'%');
        }
        return $office->paginate(10);
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
            'office_expense_head_id' => 'required',
            'month' => 'required',
            'date' => 'required',
            'amount' => 'required|numeric'
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
            $insert = OfficeExpense::insert([
                'office_expense_head_id' => $request->office_expense_head_id,
                'user_id' => Auth::id(),
                'month' => $request->month,
                'date' => $request->date,
                'amount' => $request->amount,
                'document' => $filename,
                'document_link' => $request->document_link,
                'note' => $request->note,
                'status' => $status
            ]);
            if ($insert) {
                return response()->json(['status' => 'success', 'message' => 'New Office Expense Created !']);
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
            'office_expense_head_id' => 'required',
            'month' => 'required',
            'date' => 'required',
            'amount' => 'required|numeric'
        ]);

        try {
           $status = $request->status ? 1 : 0;
           $filename = NULL;
            $update = OfficeExpense::find($id);
            $update->office_expense_head_id = $request->office_expense_head_id;
            $update->user_id = Auth::id();
            $update->month = $request->month;
            $update->date = $request->date;
            $update->amount = $request->amount;
            $update->document = $filename;
            $update->document_link = $request->document_link;
            $update->note = $request->note;
            $update->status = $status;
            if ($update->update()) {
                return response()->json(['status' => 'success', 'message' => 'Office Expense Updated !']);
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
            $delete = OfficeExpense::find($id);
            
        if ($delete->delete()) {
                return response()->json(['status' => 'success', 'message' => 'Office Expense Deleted !']);
            }else{
                return response()->json(['status' => 'error', 'message' => 'Something went wrong !']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
