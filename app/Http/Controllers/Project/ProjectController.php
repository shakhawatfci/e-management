<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Project;
use Image;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('project.project');
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

    public function projectList(Request $request)
    {
        $project = Project::orderBy('id','desc');
        if($request->keyword != '')
        {
           $project->where('vendor_name','LIKE','%'.$request->keyword.'%');
           $project->orWhere('vendor_address','LIKE','%'.$request->keyword.'%');
           $project->orWhere('vendor_phone','LIKE','%'.$request->keyword.'%');
        }
        $project = $project->paginate(10);
        return $project;
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
            'project_name' => 'required',
            'project_location' => 'required',
            'project_contact_person' => 'required',
            'project_email' => 'email|nullable',
            'project_phone' => 'required',
            'project_argument_with' => 'required'
        ]);
        try {
            $filename = NULL;
            if($request->file('project_file')){
                $data = $request->file('project_file');
                $ext = $data->getClientOriginalExtension();
                $filename = time().'.'.$ext;
                $data->move('upload/',$filename);
            }
            $project = Project::insert([
                'project_name'          => $request->project_name,
                'project_location'      => $request->project_location,
                'project_contact_person'=> $request->project_contact_person,
                'project_email'         => $request->project_email,
                'project_phone'         => $request->project_phone,
                'project_argument_with' => $request->project_argument_with,
                'project_argument_date' => $request->project_argument_date,
                'project_start_date'    => $request->project_start_date,
                'project_country'       => $request->project_country,
                'project_file'          => $filename,
                'project_details'       => $request->project_details,
                'project_status'        => $request->project_status
            ]);
            
            if($project){
                return response()->json(['status' => 'success', 'message' => 'New Project Created !']);
            }else{
                return response()->json(['status' => 'error', 'message' => 'Something went wrong !']);

            }
            
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
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
            'project_name' => 'required',
            'project_location' => 'required',
            'project_contact_person' => 'required',
            'project_email' => 'email|nullable',
            'project_phone' => 'required',
            'project_argument_with' => 'required'
        ]);

        try {
           
              $project = Project::find($id);

              $project->project_name           = $request->project_name;
              $project->project_argument_with  = $request->project_argument_with;
              $project->project_contact_person = $request->project_contact_person;
              $project->project_email          = $request->project_email;
              $project->project_phone          = $request->project_phone;
              $project->project_argument_date  = $request->project_argument_date;
              $project->project_start_date     = $request->project_start_date;
              $project->project_country        = $request->project_country;
              $project->project_location       = $request->project_location;
              $project->project_details        = $request->project_details;
              $project->project_status         = $request->project_status;
         
             if($request->file('project_file')){

                if(file_exists('upload/'.$project->project_file) && !empty($project->project_file)) { 
                   unlink('upload/'.$project->project_file);
                }
              
                $data = $request->file('project_file');
                $ext = $data->getClientOriginalExtension();
                $filename = time().'.'.$ext;
                $data->move('upload/',$filename);

                $project->project_file = $filename;
             }

            if($project->update()){
                return response()->json(['status' => 'success', 'message' => 'Project Updated !']);
            }else{
                return response()->json(['status' => 'error', 'message' => 'Something went wrong !']);

            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
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
        $count = App\CarAssign::where('project_id','=',$id)->count();
        if($count > 0)
        {
            return response()->json(['status' => 'error', 'message' => 'First delete Car Assign !']);
        }
        else {
         $data = Project::find($id);
            if(file_exists('upload/'.$data->project_file) && $data->project_file != null){ 
                unlink('upload/'.$data->project_file);
            }
         $data->delete();
            return response()->json(['status' => 'success', 'message' => 'Project Deleted !']);
        }
    }
}
