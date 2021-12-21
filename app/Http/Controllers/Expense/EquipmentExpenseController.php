<?php

namespace App\Http\Controllers\Expense;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AllStatic;
use App\EquipementExpense;
use App\EquipmentExpenseHead;
use App\EquipmentExpenseInvoice;
use App\EquipmentType;
use App\Equipement;
use App\Project;
use App\ProjectClaim;
use App\ProjectPayment;
use App\Vendor;
use DB;

class EquipmentExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project = Project::orderBy('project_name', 'asc')
            ->where('project_status', '=', AllStatic::$active)
            ->get();

        $equipment_type = EquipmentType::orderBy('name', 'asc')
            ->where('status', '=', AllStatic::$active)
            ->get();

        $vendor = Vendor::orderBy('vendor_name', 'asc')
            ->where('status', '=', AllStatic::$active)
            ->get();

        $equipement = Equipement::orderBy('eq_name', 'asc')
            ->where('eq_status', '=', AllStatic::$active)
            ->get();

        $equipment_head = EquipmentExpenseHead::orderBy('head_name', 'asc')
            ->where('status', '=', AllStatic::$active)
            ->get();

        return view('expense.equipment_expense', [
            'projects' => $project,
            'vendors' => $vendor,
            'equipment_types' => $equipment_type,
            'equipements' => $equipement,
            'equipment_heads' => $equipment_head,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function equipmentExpenseList(Request $request)
    {
        $equipment = EquipementExpense::with(['project:id,project_name','vendor:id,vendor_name','equipement:id,eq_name','equipment_type:id,name','equipment_expense_head:id,head_name'])
            ->orderBy('id','desc');
        if($request->project != '') {
            $equipment->where('project_id','=',$request->project);
        }
        if($request->vendor != '') {
            $equipment->where('vendor_id','=',$request->vendor);
        }
        if($request->equipment_type != '') {
            $equipment->where('equipment_type_id','=',$request->equipment_type);
        }
        if($request->equipement != '') {
            $equipment->where('equipement_id','=',$request->equipement);
        }
        if($request->equipment_head != '') {
            $equipment->where('equipment_expense_head_id','=',$request->equipment_head);
        }
        if($request->keyword != '') {
            $equipment->where('month','=',$request->keyword);
            $equipment->orWhere('payment_date','=',$request->keyword);
            $equipment->orWhere('amount','=',$request->keyword);
        }
        if ($request->end_month != '' && $request->end_month != 'undefined') {
            $start = date('Y-m',strtotime(str_replace('/','-',$request->start_month)));
            $end = date('Y-m',strtotime(str_replace('/','-',$request->end_month)));

            $equipment->whereBetween('month', [$start,$end]);   
        }
        return $equipment->paginate(10);
    }

    public function equipmentExpensePrint(Request $request)
    {
        $month = null;
        $equipment = EquipementExpense::with(['project:id,project_name','vendor:id,vendor_name','equipement:id,eq_name','equipment_type:id,name','equipment_expense_head:id,head_name'])
            ->orderBy('id','desc');
        if($request->project != '') {
            $equipment->where('project_id','=',$request->project);
        }
        if($request->vendor != '') {
            $equipment->where('vendor_id','=',$request->vendor);
        }
        if($request->equipment_type != '') {
            $equipment->where('equipment_type_id','=',$request->equipment_type);
        }
        if($request->equipement != '') {
            $equipment->where('equipement_id','=',$request->equipement);
        }
        if($request->equipment_head != '') {
            $equipment->where('equipment_expense_head_id','=',$request->equipment_head);
        }
        if($request->keyword != '') {
            $equipment->where('month','=',$request->keyword);
            $equipment->orWhere('payment_date','=',$request->keyword);
            $equipment->orWhere('amount','=',$request->keyword);
        }
        if ($request->end_month != '' && $request->end_month != 'undefined') {
            $start = date('Y-m',strtotime(str_replace('/','-',$request->start_month)));
            $end = date('Y-m',strtotime(str_replace('/','-',$request->end_month)));

            $equipment->whereBetween('month', [$start,$end]);
            $month .= 'From ' .$start. ' to ' .$end;  
        }
        $equipment = $equipment->get();

        if($request->action == 'print')
        {
            return view('expense.print.equipment_expense_print',[
                'equipments' => $equipment,
                'month' => $month
            ]);
        } else {
            return view('expense.pdf.equipment_expense_pdf', [
            // $pdf = \PDF::loadView('expense.pdf.equipment_expense_pdf', [
                'equipments' => $equipment,
                'month' => $month
            ]);

            $pdf->setPaper('A4', 'landscape');
            $pdf_name = "equipment_expense.pdf";
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
            'project_id' => 'required',
            'vendor_id' => 'required',
            'equipment_type_id' => 'required',
            'equipement_id' => 'required',
            'expense_category' => 'required',
            'expense_category.*' => 'required',
            'month' => 'required',
            'payment_date' => 'required',
            // 'amount' => 'required'
        ]);

        try {
            $status = $request->status ? 1 : 0;
            \DB::beginTransaction();

            $total_amount = array_sum(array_map(function($item) { 
                return $item['amount']; 
            }, $request->expense_category));

            $insertid = EquipmentExpenseInvoice::insertGetId([
                'project_id' => $request->project_id,
                'invoice_no' => $request->invoice_no,
                'vendor_id' => $request->vendor_id,
                'equipment_type_id' => $request->equipment_type_id,
                'equipement_id' => $request->equipement_id,
                // 'equipement_expense_id' => $insertid,
                'month' => date('Y-m',strtotime(str_replace('/','-',$request->month))),
                'payment_date' => $request->payment_date,
                'payment_method' => $request->payment_method,
                'total_amount' => $total_amount,
                'document' => null,
                'documents_link' => $request->documents_link,
                'note' => $request->note,
                'status' => $status
            ]);

            foreach($request->expense_category as $ex_cat){

                $insert = EquipementExpense::insert([
                    'invoice_no' => $request->invoice_no,
                    'project_id' => $request->project_id,
                    'vendor_id' => $request->vendor_id,
                    'equipment_type_id' => $request->equipment_type_id,
                    'equipment_expense_invoice_id' => $insertid,
                    'equipement_id' => $request->equipement_id,
                    'equipment_expense_head_id' => $ex_cat['category_id'],
                    'month' => date('Y-m',strtotime(str_replace('/','-',$request->month))),
                    'payment_date' => $request->payment_date,
                    'payment_method' => $request->payment_method,
                    'amount' => $ex_cat['amount'],
                    'document' => null,
                    'documents_link' => $request->documents_link,
                    'note' => $request->note,
                    'status' => $status
                ]);
            }


            

            if($insert) {
                \DB::commit();
               return response()->json(['status' => 'success', 'message' => 'Equipment Expense Created !']);
            }else{
                \DB::rollback();
                return response()->json(['status' => 'error', 'message' => 'Something went wrong !']);
            }
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function ExpenseInvoice()
    {
        return view('expense.equipment_expense_invoice');
    }

    public function ExpenseInvoiceList(Request $request)
    {
        // $equipment = EquipmentExpenseInvoice::with(['project:id,project_name','vendor:id,vendor_name','equipement:id,eq_name','equipment_type:id,name','equipment_expense_head:id,head_name'])
        // ->orderBy('id','desc');
        $equipment = EquipmentExpenseInvoice::with(['project:id,project_name','vendor:id,vendor_name','equipement:id,eq_name','equipment_expense'])
                    ->orderBy('id','desc');
        if($request->project != '') {
            $equipment->where('project_id','=',$request->project);
        }
        if($request->vendor != '') {
            $equipment->where('vendor_id','=',$request->vendor);
        }
        if($request->equipment_type != '') {
            $equipment->where('equipment_type_id','=',$request->equipment_type);
        }
        if($request->equipement != '') {
            $equipment->where('equipement_id','=',$request->equipement);
        }
        if($request->equipment_head != '') {
            $equipment->where('equipment_expense_head_id','=',$request->equipment_head);
        }
        if($request->keyword != '') {
            $equipment->where('month','=',$request->keyword);
            $equipment->orWhere('payment_date','=',$request->keyword);
            $equipment->orWhere('amount','=',$request->keyword);
        }
        if ($request->end_month != '' && $request->end_month != 'undefined') {
            $start = date('Y-m',strtotime(str_replace('/','-',$request->start_month)));
            $end = date('Y-m',strtotime(str_replace('/','-',$request->end_month)));

            $equipment->whereBetween('month', [$start,$end]);   
        }
        return $equipment->paginate(10);
    }

    public function ExpenseInvoiceData($id)
    {
        return EquipmentExpenseInvoice::with(['project:id,project_name','vendor:id,vendor_name','equipement:id,eq_name','equipment_expense'])
                ->find($id);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function equipmentExpenseData()
    {
        $project = \App\Project::all();
        $vendor = \App\Vendor::where('status',1)->get();
        $eq_type = \App\EquipmentType::where('status',1)->get();
        $equipment = \App\Equipement::all();
        $expense_category = \App\EquipmentExpenseHead::all();

        return response()->json([
            'project' => $project,
            'vendor' => $vendor,
            'eq_type' => $eq_type,
            'equipment' => $equipment,
            'expense_category' => $expense_category
        ]);
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
            'invoice_no' => 'required',
            'project_id' => 'required',
            'vendor_id' => 'required',
            'equipment_type_id' => 'required',
            'equipement_id' => 'required',
            'expense_category' => 'required',
            'expense_category.*' => 'required',
            'month' => 'required',
            'payment_date' => 'required',
            // 'amount' => 'required'
        ]);
        // dd($request->all());
        try {
            DB::beginTransaction();
            $status = $request->status ? 1 : 0;
                $total_amount = array_sum(array_map(function($item) { 
                    return $item['amount']; 
                }, $request->expense_category));

                $update = EquipmentExpenseInvoice::find($id);
            
                   $update->project_id = $request->project_id;
                   $update->invoice_no = $request->invoice_no;
                   $update->vendor_id = $request->vendor_id;
                   $update->equipment_type_id = $request->equipment_type_id;
                   $update->equipement_id = $request->equipement_id;
                //    $update->equipement_expense_id = $insertid;
                   $update->month = date('Y-m',strtotime(str_replace('/','-',$request->month)));
                   $update->payment_date = $request->payment_date;
                   $update->payment_method = $request->payment_method;
                   $update->total_amount = $total_amount;
                   $update->document = null;
                   $update->documents_link = $request->documents_link;
                   $update->note = $request->note;
                   $update->status = $status;
                   $update->update();

                   $delete = EquipementExpense::where('equipment_expense_invoice_id',$id)->delete();
                   if($delete){
                       foreach($request->expense_category as $ex_cat){
                               $insert = new EquipementExpense();
                               $insert->invoice_no = $request->invoice_no;
                               $insert->project_id = $request->project_id;
                               $insert->vendor_id = $request->vendor_id;
                               $insert->equipment_type_id = $request->equipment_type_id;
                               $insert->equipment_expense_invoice_id = $request->id;
                               $insert->equipement_id = $request->equipement_id;
                               $insert->equipment_expense_head_id = $ex_cat['category_id'];
                               $insert->month = date('Y-m',strtotime(str_replace('/','-',$request->month)));
                               $insert->payment_date = $request->payment_date;
                               $insert->payment_method = $request->payment_method;
                               $insert->amount = $ex_cat['amount'];
                               $insert->document = null;
                               $insert->documents_link = $request->documents_link;
                               $insert->note = $request->note;
                               $insert->status = $status;
                               $insert->save();
                       }
                   }

            if($update) {
                DB::commit();
               return response()->json(['status' => 'success', 'message' => 'Equipment Expense Updated !']);
            }else{
                DB::rollback();
                return response()->json(['status' => 'error', 'message' => 'Something went wrong !']);
            }
        } catch (\Exception $e) {
            DB::rollback();
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
            EquipementExpense::where('equipment_expense_invoice_id',$id)->delete();
            $delete = EquipmentExpenseInvoice::find($id)->delete();
            
        if ($delete) {
            DB::commit();
                return response()->json(['status' => 'success', 'message' => 'Equipment Expense Invoice Deleted !']);
            }else{
                return response()->json(['status' => 'error', 'message' => 'Something went wrong !']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
