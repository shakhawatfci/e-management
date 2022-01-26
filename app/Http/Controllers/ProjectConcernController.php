<?php

namespace App\Http\Controllers;

use App\ProjectConcern;
use Illuminate\Http\Request;
use Auth;

class ProjectConcernController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('concern.project_concern');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function projectConcernList(Request $request)
    {
        $concern = ProjectConcern::with('user:id,name')->orderBy('id', 'desc');
        if ($request->keyword != '') {
            $concern->where('name', 'LIKE', '%' . $request->keyword . '%');
            $concern->orWhere('phone', 'LIKE', '%' . $request->keyword . '%');
            $concern->orWhere('email', 'LIKE', '%' . $request->keyword . '%');
            $concern->orWhere('company_name', 'LIKE', '%' . $request->keyword . '%');
            $concern->orWhere('rating', 'LIKE', '%' . $request->keyword . '%');
        }
        $concern = $concern->paginate(10);
        return $concern;
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
            'name'    => 'required',
            'email'   => 'email|nullable'
        ]);
        try {

            $concern = new ProjectConcern;

            $concern->name             = $request->name;
            $concern->user_id          = Auth::user()->id;
            $concern->email            = $request->email;
            $concern->address          = $request->address;
            $concern->phone            = $request->phone;
            $concern->company_name     = $request->company_name;
            $concern->company_address  = $request->company_address;
            $concern->project_name     = $request->project_name;
            $concern->project_location = $request->project_location;
            $concern->reqired_equipment = $request->reqired_equipment;
            $concern->reference_by     = $request->reference_by;
            $concern->rating           = $request->rating;
            $concern->note             = $request->note;
            $concern->status           = $request->status;
            $concern->save();

            return response()->json(['status' => 'success', 'message' => 'Project Concern Created Successfully !']);

        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProjectConcern  $projectConcern
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectConcern $projectConcern)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProjectConcern  $projectConcern
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectConcern $projectConcern)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProjectConcern  $projectConcern
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectConcern $projectConcern)
    {
        $request->validate([
            'name'    => 'required',
            'email'   => 'email|nullable'
        ]);
        try {

            // $concern = ProjectConcern::find($request->id);

            $projectConcern->name             = $request->name;
            $projectConcern->email            = $request->email;
            $projectConcern->address          = $request->address;
            $projectConcern->phone            = $request->phone;
            $projectConcern->company_name     = $request->company_name;
            $projectConcern->company_address  = $request->company_address;
            $projectConcern->project_name     = $request->project_name;
            $projectConcern->project_location = $request->project_location;
            $projectConcern->reqired_equipment = $request->reqired_equipment;
            $projectConcern->reference_by     = $request->reference_by;
            $projectConcern->rating           = $request->rating;
            $projectConcern->note             = $request->note;
            $projectConcern->status           = $request->status;
            $projectConcern->update();

            return response()->json(['status' => 'success', 'message' => 'Concern Updated Successfully !']);

        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProjectConcern  $projectConcern
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectConcern $projectConcern)
    {
        try {
            $projectConcern->delete();

            return response()->json(['status' => 'success', 'message' => 'Project Concern Deleted']);
            
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
        
    }
}
