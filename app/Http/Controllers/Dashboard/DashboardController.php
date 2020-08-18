<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AllStatic;
use App\Equipement;
use App\EquipmentType;
use App\Project;
use App\Vendor;
use App\CarAssign;
use App\Operator;
use App\ProjectClaim;
use DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $assigned_equipments = CarAssign::with(
        //     [
        //         'equipement',
        //         'equipment_type:id,name',
        //         'vendor:id,vendor_name',
        //         'project:id,project_name',
        //         'latest_bill:id,bill_no,assign_id,month,date'
        //     ])
        //     ->orderBy('updated_at','desc'); 

        // $assigned_equipments = $assigned_equipments->get();

        // DB::table('car_assign')->leftJoin('project_claim',);


        // $last_month = date('Y-m',strtotime('-1 month'));
        // return $claim = ProjectClaim::select('assign_id')->where('month','!=',$last_month)
        // ->distinct()->get();
        // $assign = DB::table('car_assign')
        //     ->whereNotIn('id',$claim)->get();

        // return view('dashboard.dashboard',['assigned_equipments' => $assign]);
        return view('dashboard.dashboard');
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
        //
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
