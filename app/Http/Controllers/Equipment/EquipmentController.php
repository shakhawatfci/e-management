<?php

namespace App\Http\Controllers\Equipment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Equipement;
use App\Vendor;
use App\CarAssign;

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
       return view('equipment.equipment',
       [
           'vendor' => $vendor
       ]);
    }

    // getting list of equipment 

    public function equipmentList(Request $request)
    {
        $equipment = Equipement::with('vendor:id,vendor_name')->orderBy('eq_name','asc');

        if($request->vendor_id != '')
        {
           $equipment->where('vendor_id','=',$request->vendor_id);
        }

        $equipment = $equipment->paginate(10);

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
                'vendor'          => 'required'
            ]
            );

            try
            {

                
            // saving equipments 

            $equipment = new Equipement;

            $equipment->eq_name = $request->equipment_name;
            $equipment->vendor_id = $request->vendor;
            $equipment->eq_model = $request->equipment_model;
            $equipment->eq_capacity = $request->capacity;
            $equipment->note = $request->note;
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
        $equipment = Equipement::find($id);
        return $equipment;
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
                        'vendor'          => 'required'
                    ]
                    );
        
                    try
                    {
                        
                    // saving equipments 
        
                    $equipment =  Equipement::find($id);
        
                    $equipment->eq_name = $request->equipment_name;
                    $equipment->vendor_id = $request->vendor;
                    $equipment->eq_model = $request->equipment_model;
                    $equipment->eq_capacity = $request->capacity;
                    $eqequipment->note = $request->note;
                    $equipment->update();
        
                    return response()->json(['status' => 'success' , 'message' => 'Equipment Updated']);
        
                    }
                    catch(\Exception $e)
                    {
        
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
        
        $count = CarAssign::where('equipment_id','=',$id)->count();
 
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