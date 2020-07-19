<?php

namespace App\Http\Controllers\Equipment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Equipement;
use App\EquipmentType;
use App\Vendor;
use App\CarAssign;
use PDF;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $vendor = Vendor::where('status','=',1)->get();
      $equipment_types = EquipmentType::where('status','=',1)->get();
       return view('equipment.equipment',
       [
           'vendor' => $vendor,
           'equipment_types' => $equipment_types
       ]);
    }

    // getting list of equipment 

    public function equipmentList(Request $request)
    {
        $equipment = Equipement::with(['vendor:id,vendor_name','equipment_type:id,name'])
                                 ->orderBy('eq_name','asc');
        $search_keyword = $request->keyword;

        if($request->vendor_id != '')
        {
           $equipment->where('vendor_id','=',$request->vendor_id);
        }

        if($request->equipment_type_id != '')
        {
           $equipment->where('equipment_type_id','=',$request->equipment_type_id);
        }

        if($search_keyword != '')
        {
            $equipment->where(function ($query) use ($search_keyword) {
                $query->where('eq_name','LIKE','%'.$search_keyword.'%')
                      ->orWhere('eq_model', 'LIKE','%'.$search_keyword.'%')
                      ->orWhere('eq_capacity','LIKE','%'.$search_keyword.'%');
                });
        }

        $equipment = $equipment->paginate(10);

        return $equipment;

    }

    public function equipmentListPrint(Request $request)
    {
        $equipment = Equipement::with(['vendor:id,vendor_name','equipment_type:id,name'])
                                 ->orderBy('eq_name','asc');
        $search_keyword = $request->keyword;

        if($request->vendor_id != '')
        {
           $equipment->where('vendor_id','=',$request->vendor_id);
        }

        if($request->equipment_type_id != '')
        {
           $equipment->where('equipment_type_id','=',$request->equipment_type_id);
        }

        if($search_keyword != '')
        {
            $equipment->where(function ($query) use ($search_keyword) {
                $query->where('eq_name','LIKE','%'.$search_keyword.'%')
                      ->orWhere('eq_model', 'LIKE','%'.$search_keyword.'%')
                      ->orWhere('eq_capacity','LIKE','%'.$search_keyword.'%');
                });
        }

        $equipment = $equipment->get();

        if($request->action == 'print')
        {
            return view('equipment.print.equipment_print',['equipments' => $equipment]);
        } else {
            $pdf = PDF::loadView('equipment.pdf.equipment_pdf', [
            // return view('equipment.pdf.equipment_pdf', [
                'equipments' => $equipment]);

            $pdf->setPaper('A4', 'landscape');
            $pdf_name = "equipment-list.pdf";
            return $pdf->download($pdf_name);
        }

    }

    public function vendroEquipment($type = 0,$id)
    {

        $equipment = Equipement::where('vendor_id','=',$id);
        
                               if($type != 0)
                                {
                                $equipment->where('equipment_type_id','=',$type);
                                }
                                $equipment = $equipment->get();

        return $equipment;

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
        // validation for equipment 
        
        $request->validate(
            [
                'equipment_name'  => 'required|unique:equipement,eq_name',
                'equipment_model' => 'required',
                'vendor'          => 'required',
                'equipment_type'  => 'required'
            ]
            );

            try
            {
                
            // saving equipments 

            $equipment = new Equipement;

            $equipment->eq_name = $request->equipment_name;
            $equipment->vendor_id = $request->vendor;
            $equipment->equipment_type_id = $request->equipment_type;
            $equipment->eq_model = $request->equipment_model;
            $equipment->eq_capacity = $request->capacity;
            $equipment->note = $request->note;
            $equipment->eq_status = $request->status  ? $request->status : 1;
            $equipment->save();

            return response()->json(['status' => 'success' , 'message' => 'Equipment Added']);

            }
            catch(\Exception $e)
            {
            // return $e;
            return response()->json(['status' => 'error' , 'message' => $e->getMessage()]);

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

        // validation for equipment 

        $request->validate(
            [
                'equipment_name'  => 'required|unique:equipement,eq_name,'.$id,
                'equipment_model' => 'required',
                'vendor'          => 'required',
                'equipment_type'  => 'required'
            ]
            );

            try
            {
                
            // saving equipments 

            $equipment =  Equipement::find($id);

            $equipment->eq_name = $request->equipment_name;
            $equipment->vendor_id = $request->vendor;
            $equipment->equipment_type_id = $request->equipment_type;
            $equipment->eq_model = $request->equipment_model;
            $equipment->eq_capacity = $request->capacity;
            $equipment->note = $request->note;
            $equipment->eq_status = $request->status;
            $equipment->update();

            return response()->json(['status' => 'success' , 'message' => 'Equipment Updated']);

            }
            catch(\Exception $e)
            {
            // return $e;
            return response()->json(['status' => 'error' , 'message' => $e->getMessage()]);

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
        // check equipment already assign to a project or not before deleting 
        
        $count = CarAssign::where('equipement_id','=',$id)->count();
 
        if($count > 0 ) 
        {
          return response()->json(['status' => 'error' , 'message' => 'Equipment already Assinged in a project']);
        }
        else
        {
        
             $equipment = Equipement::find($id);
             $equipment->delete();

             return response()->json(['status' => 'success' , 'message' => 'Equipment Deleted']);


        }
    }
}
