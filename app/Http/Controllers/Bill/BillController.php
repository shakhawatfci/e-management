<?php

namespace App\Http\Controllers\Bill;

use App\AllStatic;
use App\Equipement;
use App\EquipmentType;
use App\Http\Controllers\Controller;
use App\Project;
use App\Vendor;
use App\CarAssign;
use App\Operator;
use App\ProjectClaim;
use Auth;
use Illuminate\Http\Request;

class BillController extends Controller
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

    $operator = Operator::orderBy('name', 'asc')
        ->where('status', '=', AllStatic::$active)
        ->get();

    return view('bill.bill', [
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
