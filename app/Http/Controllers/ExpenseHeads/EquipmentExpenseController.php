<?php

namespace App\Http\Controllers\ExpenseHeads;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\EquipmentExpenseHead;
use PDF;

class EquipmentExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('expense_heads.equipment_expense_heads');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function EquipmentHeadList(Request $request)
    {
        $equipments = EquipmentExpenseHead::orderBy('id','desc');
        if ($request->keyword != '') {
            $equipments->where('head_name','LIKE','%'.$request->keyword.'%');
        }
        return $equipments->paginate(10);
    }

    public function EquipmentHeadListPrint(Request $request)
    {
        $equipments = EquipmentExpenseHead::orderBy('id','desc');
        if ($request->keyword != '') {
            $equipments->where('head_name','LIKE','%'.$request->keyword.'%');
        }
        $equipment = $equipments->get();

        if($request->action == 'print')
        {
            return view('expense_heads.print.equipment_expense_head_print',['equipment_heads' => $equipment]);
        } else {
            // $pdf = PDF::loadView('expense_heads.pdf.equipment_expense_head_pdf', [
            return view('expense_heads.pdf.equipment_expense_head_pdf', [
                'equipment_heads' => $equipment]);

            $pdf->setPaper('A4', 'landscape');
            $pdf_name = "equipment-expense-category.pdf";
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
            $equipment = EquipmentExpenseHead::insert([
                'head_name' => $request->head_name,
                'status' => $status
            ]);

            if($equipment){
                return response()->json(['status' => 'success', 'message' => 'New Equipment Expense Head Created !']);
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
            $equipment = EquipmentExpenseHead::find($id);
            $equipment->head_name = $request->head_name;
            $equipment->status = $status;
            
            if($equipment->update()){
                return response()->json(['status' => 'success', 'message' => 'Equipment Expense Head Updated !']);
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
            $equipment = EquipmentExpenseHead::find($id);
            if($equipment->delete()){
                return response()->json(['status' => 'success', 'message' => 'Equipment Expense Head Deleted !']);
            }else{
                return response()->json(['status' => 'error', 'message' => 'Something went wrong !']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
        
    }
}
