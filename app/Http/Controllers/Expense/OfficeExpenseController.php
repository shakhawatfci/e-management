<?php

namespace App\Http\Controllers\Expense;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\OfficeExpense;
use App\OfficeExpenseInvoice;
use App\AllStatic;
use App\OfficeExpenseHead;
use Auth,DB;

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

    public function officeExpenseInvoice()
    {
        return view('expense.office_expense_invoice');
    }

    public function officeExpenseInvoiceList(Request $request)
    {
        // 
        $office = OfficeExpenseInvoice::orderBy('id','desc');
        
        if($request->keyword != '') {
            $office->where('invoice_no','LIKE','%'.$request->keyword.'%');
            $office->orWhere('month','LIKE','%'.$request->keyword.'%');
            $office->orWhere('date','LIKE','%'.$request->keyword.'%');
            $office->orWhere('total_amount','LIKE','%'.$request->keyword.'%');
        }
        if ($request->end_month != '' && $request->end_month != 'undefined') {
            $start = date('Y-m',strtotime(str_replace('/','-',$request->start_month)));
            $end = date('Y-m',strtotime(str_replace('/','-',$request->end_month)));

            $office->whereBetween('month', [$start,$end]);
            
        }
        return $office->paginate(10);
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
            // $office->where('project_id','LIKE','%'.$request->keyword.'%');
            $office->where('month','LIKE','%'.$request->keyword.'%');
            $office->orWhere('date','LIKE','%'.$request->keyword.'%');
            $office->orWhere('amount','LIKE','%'.$request->keyword.'%');
        }
        if ($request->end_month != '' && $request->end_month != 'undefined') {
            $start = date('Y-m',strtotime(str_replace('/','-',$request->start_month)));
            $end = date('Y-m',strtotime(str_replace('/','-',$request->end_month)));

            $office->whereBetween('month', [$start,$end]);
            
        }
        return $office->paginate(10);
    }

    public function officeExpensePrint(Request $request)
    {
        $month = null; 
        $office = OfficeExpense::with(['office_expense_head:id,head_name'])->orderBy('id','desc');
        if($request->office_head != '') {
            $office->where('office_expense_head_id','=',$request->office_head);
        }
        if($request->keyword != '') {
            $office->where('month','LIKE','%'.$request->keyword.'%');
            $office->orWhere('date','LIKE','%'.$request->keyword.'%');
            $office->orWhere('amount','LIKE','%'.$request->keyword.'%');
        }
        if ($request->end_month != '' && $request->end_month != 'undefined') {
            $start = date('Y-m',strtotime(str_replace('/','-',$request->start_month)));
            $end = date('Y-m',strtotime(str_replace('/','-',$request->end_month)));

            $office->whereBetween('month', [$start,$end]);
            
            $month .= 'From ' .$start. ' to ' .$end;
        }
        $office = $office->get();

        if($request->action == 'print')
        {
            return view('expense.print.office_expense_print',[
                'offices' => $office,
                'month' => $month
            ]);
        } else {
            // return view('expense.pdf.office_expense_pdf', [
            $pdf = \PDF::loadView('expense.pdf.office_expense_pdf', [
                'offices' => $office,
                'month' => $month
            ]);

            $pdf->setPaper('A4', 'landscape');
            $pdf_name = "office_expense.pdf";
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
            'invoice_no' => 'required',
            'month' => 'required',
            'date' => 'required',
            'expense_category' => 'required|min:1'
        ]);

        try {
            \DB::beginTransaction();
           $status = $request->status ? 1 : 0;

           $total_amount = array_sum(array_map(function($item) { 
                return $item['amount']; 
            }, $request->expense_category));

           $filename = NULL;
            // if($request->file('document')){
            //     $data = $request->file('document');
            //     $ext = $data->getClientOriginalExtension();
            //     $filename = time().'.'.$ext;
            //     $data->move('upload/',$filename);
            // }

            $insertid = OfficeExpenseInvoice::insertGetId([
                'invoice_no' => $request->invoice_no,
                'user_id' => Auth::id(),
                'month' => date('Y-m',strtotime(str_replace('/','-',$request->month))),
                'date' => $request->date,
                'total_amount' => $total_amount,
                'document' => $filename,
                'document_link' => $request->document_link,
                'note' => $request->note,
                'status' => $status
            ]);

            foreach($request->expense_category as $ex_cat){

                $insert = OfficeExpense::insert([
                    'invoice_no' => $request->invoice_no,
                    'office_expense_head_id' => $ex_cat['category_id'],
                    'user_id' => Auth::id(),
                    'office_expense_invoice_id' => $insertid,
                    'month' => date('Y-m',strtotime(str_replace('/','-',$request->month))),
                    'date' => $request->date,
                    'amount' => $ex_cat['amount'],
                    'document' => $filename,
                    'document_link' => $request->document_link,
                    'note' => $request->note,
                    'status' => $status
                ]);
            }

           DB::commit();
            if ($insert) {
                return response()->json(['status' => 'success', 'message' => 'New Office Expense Invocie Created !']);
            }else{
                DB::rollback();
                return response()->json(['status' => 'error', 'message' => 'Something went wrong !']);

            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function officeExpense($id)
    {
        return OfficeExpense::where('office_expense_invoice_id',$id)->with('office_expense_head:id,head_name')
                        ->get();
    }

    public function printExpenseInvoice(Request $request)
    {
        $invoice_data = $this->show($request->id);
        $category_data = $this->officeExpense($request->id);

        if($request->action == 'print')
        {
            return view('expense.print.office_expense_invoice_print',['office_expense' => $invoice_data,'expense_category' => $category_data]);
        } else {
            // return view('expense.pdf.office_expense_expense_invoice_pdf',['office_expense' => $invoice_data,'expense_category' => $category_data]);
            $pdf = \PDF::loadView('expense.pdf.office_expense_invoice_pdf',['office_expense' => $invoice_data,'expense_category' => $category_data]);

            $pdf->setPaper('A4', 'landscape');
            $pdf_name = "office-invoice-".$invoice_data->invoice_no.".pdf";
            return $pdf->download($pdf_name);
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
        return OfficeExpenseInvoice::with('office_expense')->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return OfficeExpenseInvoice::with('office_expense')->find($id);
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
            'invoice_no' => 'required',
            'month' => 'required',
            'date' => 'required',
            'expense_category' => 'required|min:1'
        ]);

        try {
            \DB::beginTransaction();
           $status = $request->status ? 1 : 0;

           $total_amount = array_sum(array_map(function($item) { 
                return $item['amount']; 
            }, $request->expense_category));

           $filename = NULL;
            // if($request->file('document')){
            //     $data = $request->file('document');
            //     $ext = $data->getClientOriginalExtension();
            //     $filename = time().'.'.$ext;
            //     $data->move('upload/',$filename);
            // }

            $update = OfficeExpenseInvoice::find($id);
            $update->invoice_no = $request->invoice_no;
            $update->user_id = Auth::id();
            $update->month = date('Y-m',strtotime(str_replace('/','-',$request->month)));
            $update->date = $request->date;
            $update->total_amount = $total_amount;
            $update->document = $filename;
            $update->document_link = $request->document_link;
            $update->note = $request->note;
            $update->status = $status;
            $update->update();

            $delete = OfficeExpense::where('office_expense_invoice_id',$id)->delete();
            if($delete){

                foreach($request->expense_category as $ex_cat){

                    $insert = OfficeExpense::insert([
                        'invoice_no' => $request->invoice_no,
                        'office_expense_head_id' => $ex_cat['category_id'],
                        'user_id' => Auth::id(),
                        'office_expense_invoice_id' => $update->id,
                        'month' => date('Y-m',strtotime(str_replace('/','-',$request->month))),
                        'date' => $request->date,
                        'amount' => $ex_cat['amount'],
                        'document' => $filename,
                        'document_link' => $request->document_link,
                        'note' => $request->note,
                        'status' => $status
                    ]);
                }
            }

           DB::commit();
            if ($insert) {
                return response()->json(['status' => 'success', 'message' => 'Office Expense Invocie Updated !']);
            }else{
                DB::rollback();
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
            DB::beginTransaction();
            OfficeExpense::where('office_expense_invoice_id',$id)->delete();
            $delete = OfficeExpenseInvoice::find($id)->delete();
            
        if ($delete) {
            DB::commit();
                return response()->json(['status' => 'success', 'message' => 'Office Expense Invoice Deleted !']);
            }else{
                return response()->json(['status' => 'error', 'message' => 'Something went wrong !']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
