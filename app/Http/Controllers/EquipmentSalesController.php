<?php

namespace App\Http\Controllers;

use App\EquipmentSales;
use App\EquipmentType;
use Illuminate\Http\Request;
use Auth;
use Session;

class EquipmentSalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipment_type = EquipmentType::orderBy('name','asc')->get();
       return view('sales.equipment.equipment_sales',['equipment_types' => $equipment_type]);
    }

    public function equipmentSalesList(Request $request)
    {
         
        $sales = EquipmentSales::with(['user:id,name','equipment_type:id,name'])->
                                orderBy('month','desc');

                 if($request->keyword != '')
                 {
                   $sales->where('customer_name','LIKE','%'.$requuest->keyword.'%');
                 }

                 if($request->equipment_type != '')
                 {
                   $sales->where('equipment_type_id','=',$request->equipment_type);
                 }

                 if($request->user != '')
                 {
                   $sales->where('user','=',$request->user);
                 }

                 $sales = $sales->paginate(10);
                 return $sales;

                 

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
            'equipment_type'      => 'required',
            'customer_name'       => 'required',
            'month'               => 'required',
            'date'                => 'required',
            'profit'              => 'required|gt:0|regex:/^[0-9]+(\.[0-9]{1,10})?$/'
        ]);

        try
        { 
          $sales = new EquipmentSales;
          $sales->equipment_type_id = $request->equipment_type;
          $sales->customer_name = $request->customer_name;
          $sales->month = date('Y-m',strtotime(str_replace('/','-',$request->month)));
          $sales->date = $request->date;
          $sales->profit = $request->profit;
          $sales->note = $request->note;
          $sales->status = 1;
          $sales->user_id = Auth::user()->id;
          $sales->save();
          return response()->json(['status'=>'success','message' => 'request successful']);
        }
        catch(\Exception $e)
        {
           return response()->json(['status'=>'error','message' => $e->getMessage()]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EquipmentSales  $equipmentSales
     * @return \Illuminate\Http\Response
     */
    public function show(EquipmentSales $equipmentSales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EquipmentSales  $equipmentSales
     * @return \Illuminate\Http\Response
     */
    public function edit(EquipmentSales $equipmentSales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EquipmentSales  $equipmentSales
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EquipmentSales $sales,$id)
    {
        $request->validate([
            'equipment_type'      => 'required',
            'customer_name'       => 'required',
            'month'               => 'required',
            'date'                => 'required',
            'profit'              => 'required|gt:0|regex:/^[0-9]+(\.[0-9]{1,10})?$/'
        ]);

        try
        { 
          $sales = EquipmentSales::find($id);
          $sales->equipment_type_id = $request->equipment_type;
          $sales->customer_name = $request->customer_name;
          $sales->month = date('Y-m',strtotime(str_replace('/','-',$request->month)));
          $sales->date = $request->date;
          $sales->profit = $request->profit;
          $sales->note = $request->note;
          $sales->status = 1;
          $sales->user_id = Auth::user()->id;
          $sales->update();
          return response()->json(['status'=>'success','message' => 'Request successful']);
        }
        catch(\Exception $e)
        {
           return response()->json(['status'=>'error','message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EquipmentSales  $equipmentSales
     * @return \Illuminate\Http\Response
     */
    public function destroy(EquipmentSales $equipmentSales)
    {
        $equipmentSales->delete();
        return response()->json(['status'=>'success','message' => 'Data Deleted']);
    }
}
