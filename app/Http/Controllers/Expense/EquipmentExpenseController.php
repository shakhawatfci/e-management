<?php

namespace App\Http\Controllers\Expense;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AllStatic;
use App\EquipementExpense;
use App\EquipmentExpenseHead;
use App\EquipmentType;
use App\Equipement;
use App\Project;
use App\ProjectClaim;
use App\ProjectPayment;
use App\Vendor;

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
            $equipment->where('project_id','LIKE','%'.$request->keyword.'%');
        }
        return $equipment->paginate(10);
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
            'project_id' => 'required',
            'vendor_id' => 'required',
            'equipment_type_id' => 'required',
            'equipement_id' => 'required',
            'expense_category_id' => 'required',
            'month' => 'required',
            'payment_date' => 'required',
            'amount' => 'required'
        ]);
        try {
            $status = $request->status ? 1 : 0;
            $insert = EquipementExpense::insert([
                'project_id' => $request->project_id,
                'vendor_id' => $request->vendor_id,
                'equipment_type_id' => $request->equipment_type_id,
                'equipement_id' => $request->equipement_id,
                'equipment_expense_head_id' => $request->expense_category_id,
                'month' => date('Y-m',strtotime($request->month)),
                'payment_date' => $request->payment_date,
                'amount' => $request->amount,
                'document' => null,
                'documents_link' => $request->documents_link,
                'note' => $request->note,
                'status' => $status
            ]);

            if($insert) {
               return response()->json(['status' => 'success', 'message' => 'Equipment Expense Created !']);
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
            'project_id' => 'required',
            'vendor_id' => 'required',
            'equipment_type_id' => 'required',
            'equipement_id' => 'required',
            'equipment_expense_head_id' => 'required',
            'month' => 'required',
            'payment_date' => 'required',
            'amount' => 'required'
        ]);

        try {
            $status = $request->status ? 1 : 0;
            $update = EquipementExpense::find($id);
                $update->project_id = $request->project_id;
                $update->vendor_id = $request->vendor_id;
                $update->equipment_type_id = $request->equipment_type_id;
                $update->equipement_id = $request->equipement_id;
                $update->equipment_expense_head_id = $request->equipment_expense_head_id;
                $update->month = date('Y-m',strtotime($request->month));
                $update->payment_date = $request->payment_date;
                $update->amount = $request->amount;
                $update->documents_link = $request->documents_link;
                $update->note = $request->note;
                $update->status = $status;

            if($update->update()) {
               return response()->json(['status' => 'success', 'message' => 'Equipment Expense Updated !']);
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
            $delete = EquipementExpense::find($id);
            
        if ($delete->delete()) {
                return response()->json(['status' => 'success', 'message' => 'Equipment Expense Deleted !']);
            }else{
                return response()->json(['status' => 'error', 'message' => 'Something went wrong !']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
