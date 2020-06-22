<?php

namespace App\Http\Controllers\Equipment;

use App\AllStatic;
use App\Equipment;
use App\EquipmentType;
use App\Http\Controllers\Controller;
use App\Project;
use App\Vendor;
use App\CarAssign;
use App\Operator;
use Illuminate\Http\Request;

class EquipmentAssignController extends Controller
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

        $operator = Vendor::orderBy('operator_name', 'asc')
            ->where('status', '=', AllStatic::$active)
            ->get();

        return view('project.assign_equipment', [
            'projects'         =>  $project,
            'vendors'          =>  $vendor,
            'equipment_types'  =>  $equipment_type,
            'operators'         =>  $operator
        ]);

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
           'project'                 => 'required',
           'equipment_type'          => 'required',
           'vendor'                  => 'required',
           'equipment'               => 'required',
           'total_hour'              => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
           'total_project_amount'    => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
           'total_vendor_amout'      => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
           'project_rate_per_hour'   => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
           'venodr_rate_per_hour'    => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
           'assign_date'             => 'required',
       ]);

       try
       {
        //    check this equipment currently working on some other project or not released from others project 
        
        $count_active = CarAssign::where('equipment_id','=',$request->equipment_id)
                                  ->where('release_status','=',AllStatic::$active)
                                  ->count();
         if($count_active > 0)
         {
           return response()->json([
               'status' => 'error',
               'message'=>'This Equipment Not Released from others project release it first'
               ]);
         }
         
        //  otherwise save it 

        $equipment_assign = new CarAssign;
        $equipment_assign->project_id             =   $request->project;
        $equipment_assign->equipment_type_id      =   $request->equipment_type;
        $equipment_assign->vendor_id              =   $request->vendor;
        $equipment_assign->equipement_id          =   $request->equipment;
        $equipment_assign->user_id                =   Auth::user()->id;
        $equipment_assign->operator_id            =   $request->operator;
        $equipment_assign->total_hour             =   $request->total_hour;
        $equipment_assign->total_project_amount   =   $request->total_project_amount;
        $equipment_assign->total_vendor_amount    =   $request->total_vendor_amount;
        $equipment_assign->project_rate_per_hour  =   $request->total_vendor_amount;
        $equipment_assign->vendor_rate_per_hour   =   $request->total_vendor_amount;
        $equipment_assign->documents_links        =   $request->documents_links;
        $equipment_assign->assign_date            =   $request->assign_date;
        $equipment_assign->release_status         =   1;
        $equipment_assign->status                 =   1;
        $equipment_assign->save;

        return response()->json([
            'status'  => 'success',
            'message' => 'Equipment Assigned'
            ]);

       }
       catch(\Exception $e)
       {

        return response()->json(['status'=>'error','message'=>$e->getMessage()]);

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
            'project'                 => 'required',
            'equipment_type'          => 'required',
            'vendor'                  => 'required',
            'equipment'               => 'required',
            'total_hour'              => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'total_project_amount'    => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'total_vendor_amout'      => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'project_rate_per_hour'   => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'venodr_rate_per_hour'    => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'assign_date'             => 'required',
        ]);
 
        try
        {

 
         $equipment_assign = new CarAssign;
         $equipment_assign->project_id             =   $request->project;
         $equipment_assign->equipment_type_id      =   $request->equipment_type;
         $equipment_assign->vendor_id              =   $request->vendor;
         $equipment_assign->equipement_id          =   $request->equipment;
         $equipment_assign->user_id                =   Auth::user()->id;
         $equipment_assign->operator_id            =   $request->operator;
         $equipment_assign->total_hour             =   $request->total_hour;
         $equipment_assign->total_project_amount   =   $request->total_project_amount;
         $equipment_assign->total_vendor_amount    =   $request->total_vendor_amount;
         $equipment_assign->project_rate_per_hour  =   $request->total_vendor_amount;
         $equipment_assign->vendor_rate_per_hour   =   $request->total_vendor_amount;
         $equipment_assign->documents_links        =   $request->documents_links;
         $equipment_assign->assign_date            =   $request->assign_date;
         $equipment_assign->update;
 
         return response()->json([
             'status'  => 'success',
             'message' => 'information updated'
             ]);
 
        }
        catch(\Exception $e)
        {
 
         return response()->json(['status'=>'error','message'=>$e->getMessage()]);
 
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
        try
        {

        //   check it's having any bill or not 

        $bill_count = ProjectClaim::where('assign_id','=',$id)->count();

        if($bill_count > 0) {

            return response()->json(
                [
                'status'   => 'error',
                'message'  => 'This assigned equipment having bill can\'t delete it untill delete the bill'
                ]
                );
           }

          $equipment_assign = CarAssign::find($id);
          $equipment_assign->delete();
          return response()->json(['status'=>'success','message' => 'information Deleted']);

        }
        catch(\Exception $e)
        {
              response()->json(['status'=>'error','message' => $e->getMessage()]);
        }
    }
}
