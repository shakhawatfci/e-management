<?php

namespace App\Http\Controllers;

use App\Mobilization;
use App\Vendor;
use App\Project;
use App\EquipmentType;
use App\Equipement;
use Auth;
use DB;
use Illuminate\Http\Request;

class MobilizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        $project = Project::orderBy('project_name', 'asc')
            
            ->get();

        $equipment_type = EquipmentType::orderBy('name', 'asc')
            
            ->get();

        $vendor = Vendor::orderBy('vendor_name', 'asc')
            
            ->get();


            return view('mobilization.mobilization',[
                'projects' => $project,
                'vendors' => $vendor,
                'equipment_types' => $equipment_type,
            ]);
    }


    public function mobilzationList(Request $request)
    {
        $per_page = 10;

        $search_keyword = $request->keyword;

        if ($request->per_page > 0) {
            $per_page = $request->per_page;
        }

        $mob = Mobilization::with([
            'user:id,name',
            'equipement:id,eq_name,eq_model',
            'equipment_type:id,name',
            'vendor:id,vendor_name',
            'project:id,project_name'
        ])->orderBy('updated_at', 'desc');

        if ($request->project_id != '') {
            $mob->where('project_id', '=', $request->project_id);
        }

        if ($request->month != '') {
            $mob->where('month', '=', $request->month);
        }

        if($search_keyword != '')
        {
            $mob->where(function ($query) use ($search_keyword) {
                $query->where('destination_from','LIKE','%'.$search_keyword.'%')
                      ->orWhere('destination_to', 'LIKE','%'.$search_keyword.'%');
            });
        }

        if ($request->vendor_id != '') {
            $mob->where('vendor_id', '=', $request->vendor_id);
        }

        if ($request->equipment_id != '') {
            $mob->where('equipment_id', '=', $request->equipment_id);
        }

        if ($request->equipment_type_id != '') {
            $mob->where('equipment_type_id', '=', $request->equipment_type_id);
        }

        $mob = $mob->paginate($per_page);

        return $mob;
            
         
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
            'month'               => 'required:date_format:Y-m',
            'date'                => 'required',
            'destination_from'    => 'required',
            'destination_to'      => 'required',
            'project_given_amount'=> 'required|gt:0|regex:/^[0-9]+(\.[0-9]{1,10})?$/',
            'lobaid_cost'         => 'required|gt:0|regex:/^[0-9]+(\.[0-9]{1,10})?$/',
            'profit'              => 'required|gt:0|regex:/^[0-9]+(\.[0-9]{1,10})?$/',
        ],[
            'month.date_format'   => 'Month Format Must Be yyyy-mm as like 2020-02'
        ]);

        try
        {
          $mob = new Mobilization;
          $mob->project_id               =      $request->project;
          $mob->vendor_id                =      $request->vendor;
          $mob->equipment_type_id        =      $request->equipment_type;
          $mob->equipment_id             =      $request->equipment;
          $mob->date                     =      $request->date;
          $mob->month                    =      $request->month;
          $mob->destination_from         =      $request->destination_from;
          $mob->destination_to           =      $request->destination_to;
          $mob->project_given_amount     =      $request->project_given_amount;
          $mob->lobaid_cost              =      $request->lobaid_cost;
          $mob->profit                   =      $request->profit;
          $mob->user_id                  =      Auth::user()->id;
          $mob->status                   =      1;
          $mob->save();

          return response()->json(['status'=>'success','message'=>'mobilization added']);
        }
        catch(\Exception $e)
        {
          return response()->json(['status' => 'error','message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mobilization  $mobilization
     * @return \Illuminate\Http\Response
     */
    public function show(Mobilization $mobilization)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mobilization  $mobilization
     * @return \Illuminate\Http\Response
     */
    public function edit(Mobilization $mobilization)
    {
        $equipments  = Equipement::wehre('vendor_id','=',$mobilization->vendor_id);

        return response()->json(['mobilization' => $mobilization,'equipments'=>$equipments]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mobilization  $mobilization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

        $request->validate([
            'month'                      =>     'required:date_format:Y-m',
            'date'                       =>     'required',
            'destination_from'           =>     'required',
            'destination_to'             =>     'required',
            'project_given_amount'       =>     'required|gt:0|regex:/^[0-9]+(\.[0-9]{1,10})?$/',
            'lobaid_cost'                =>     'required|gt:0|regex:/^[0-9]+(\.[0-9]{1,10})?$/',
            'profit'                     =>     'required|gt:0|regex:/^[0-9]+(\.[0-9]{1,10})?$/',
        ],
        [
            'month.date_format'          =>     'Month Format Must Be yyyy-mm as like 2020-02'
        ]);
        
        try
        {
          $mob = Mobilization::find($id);
          $mob->project_id               =      $request->project;
          $mob->vendor_id                =      $request->vendor;
          $mob->equipment_type_id        =      $request->equipment_type;
          $mob->equipment_id             =      $request->equipment;
          $mob->date                     =      $request->date;
          $mob->month                    =      $request->month;
          $mob->destination_from         =      $request->destination_from;
          $mob->destination_to           =      $request->destination_to;
          $mob->project_given_amount     =      $request->project_given_amount;
          $mob->lobaid_cost              =      $request->lobaid_cost;
          $mob->profit                   =      $request->profit;
          $mob->user_id                  =      Auth::user()->id;
          $mob->status                   =      1;
          $mob->update();

          return response()->json(['status'=>'success','message'=>'mobilization updated']);
        }
        catch(\Exception $e)
        {
          return response()->json(['status' => 'error','message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mobilization  $mobilization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mobilization $mobilization)
    {
        $mobilization->delete();
        return response()->json(['status'=>'success','message' => 'data deleted']);
    }
}
