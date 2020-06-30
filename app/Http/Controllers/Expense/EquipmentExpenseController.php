<?php

namespace App\Http\Controllers\Expense;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\EquipementExpense;

class EquipmentExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('expense.equipment_expense');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function equipmentExpenseList(Request $request)
    {
        $equipment = EquipementExpense::with(['project:id,project_name','vendor:id,vendor_name','equipement:id,eq_name','expense_category:id,expense_title'])->orderBy('id','desc');
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
        // $equipment = \App\Equipement::all();
        $expense_category = \App\EquipmentExpenseHead::all();

        return response()->json([
            'project' => $project,
            'vendor' => $vendor,
            'eq_type' => $eq_type,
            // 'equipment' => $equipment,
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
