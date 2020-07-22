<?php

namespace App\Http\Controllers\Equipment;

use App\Http\Controllers\Controller;
use App\EquipmentType;
use App\Equipement;
use Illuminate\Http\Request;
use PDF;

class EquipmentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('equipment.equipment_type');
    }

    public function equipmentTypeList(Request $request)
    {
        $equipment_type = EquipmentType::orderBy('name','asc');

        if($request->keyword != '')
        {
          $equipment_type->where('name','LIKE','%'.$request->keyword.'%');
        }

        $equipment_type = $equipment_type->paginate(10);

        return $equipment_type;
    }

    public function equipmentTypeListPrint(Request $request)
    {
        $equipment_type = EquipmentType::orderBy('name','asc');

        if($request->keyword != '')
        {
          $equipment_type->where('name','LIKE','%'.$request->keyword.'%');
        }

        $equipment_type = $equipment_type->get();

        if($request->action == 'print')
        {
            return view('equipment.print.equipment_type_print',['equipment_types' => $equipment_type]);
        } else {
            $pdf = PDF::loadView('equipment.pdf.equipment_type_pdf', [
            // return view('equipment.pdf.equipment_type_pdf', [
                'equipment_types' => $equipment_type]);

            $pdf->setPaper('A4', 'landscape');
            $pdf_name = "equipment-category-list.pdf";
            return $pdf->download($pdf_name);
        }
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
        $request->validate([
            'name' => 'required|unique:equipment_types'
        ]);

        try{
        
            $equipment_type = new EquipmentType;

            $equipment_type->name  =  $request->name;
            $equipment_type->note         =  $request->note;
            $equipment_type->status       =  $request->status;
            $equipment_type->save();

            return response()->json(['status'=>'success','message'=>'Equipment Category Added']);
 
        }

        catch(\Exception $e)
        {
           return response()->json(['status' => 'error','message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EquipmentType  $equipmentType
     * @return \Illuminate\Http\Response
     */
    public function show(EquipmentType $equipmentType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EquipmentType  $equipmentType
     * @return \Illuminate\Http\Response
     */
    public function edit(EquipmentType $equipmentType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EquipmentType  $equipmentType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EquipmentType $equipmentType)
    {
        $request->validate([
            'name' => 'required|unique:equipment_types,name,'.$equipmentType->id,
        ]);

        try
        {
        
            $equipmentType               = new EquipmentType;

            $equipmentType->name         =  $request->name;
            $equipmentType->note         =  $request->note;
            $equipmentType->status       =  $request->status;
            $equipmentType->update();

            return response()->json(['status'=>'success','message'=>'Equipment Category Added']);
 
        }

        catch(\Exception $e)
        {
           return response()->json(['status' => 'error','message' => $e->getMessage()]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EquipmentType  $equipmentType
     * @return \Illuminate\Http\Response
     */
    public function destroy(EquipmentType $equipmentType)
    {
       try
       {
        //  checking this category already having equipment or not before delete
        $equipment_count_by_category = Equipement::where('equipment_type_id','=',$equipmentType->id)
        ->count();

        if($equipment_count_by_category > 0) 
        {
            return response()->json(['status' => 'error','message' => 'This Category Having Equipment Please Delete it first']);
        }
        
       }
       catch(\Exception $e)
       {
          return response()->json(['status' => 'error','message' => $e->getMessage()]);
       }

    }
}
