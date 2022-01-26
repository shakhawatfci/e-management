<?php

namespace App\Http\Controllers;

use App\VendorConcern;
use Illuminate\Http\Request;
use Auth;

class VendorConcernController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('concern.vendor_concern');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function vendorConcernList(Request $request)
    {
        $concern = VendorConcern::with('user:id,name')->orderBy('id', 'desc');
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

            $concern = new VendorConcern;

            $concern->name             = $request->name;
            $concern->user_id          = Auth::user()->id;
            $concern->email            = $request->email;
            $concern->address          = $request->address;
            $concern->phone            = $request->phone;
            $concern->company_name     = $request->company_name;
            $concern->company_address  = $request->company_address;
            $concern->available_equipment = $request->available_equipment;
            $concern->introduce_by     = $request->introduce_by;
            $concern->rating           = $request->rating;
            $concern->note             = $request->note;
            $concern->status           = $request->status;
            $concern->save();

            return response()->json(['status' => 'success', 'message' => 'Vendor Concern Created Successfully !']);

        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VendorConcern  $vendorConcern
     * @return \Illuminate\Http\Response
     */
    public function show(VendorConcern $vendorConcern)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VendorConcern  $vendorConcern
     * @return \Illuminate\Http\Response
     */
    public function edit(VendorConcern $vendorConcern)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VendorConcern  $vendorConcern
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VendorConcern $vendorConcern)
    {
        $request->validate([
            'name'    => 'required',
            'email'   => 'email|nullable'
        ]);
        try {

            // $concern = ProjectConcern::find($request->id);

            $vendorConcern->name             = $request->name;
            $vendorConcern->email            = $request->email;
            $vendorConcern->address          = $request->address;
            $vendorConcern->phone            = $request->phone;
            $vendorConcern->company_name     = $request->company_name;
            $vendorConcern->company_address  = $request->company_address;
            $vendorConcern->available_equipment = $request->available_equipment;
            $vendorConcern->introduce_by     = $request->introduce_by;
            $vendorConcern->rating           = $request->rating;
            $vendorConcern->note             = $request->note;
            $vendorConcern->status           = $request->status;
            $vendorConcern->update();

            return response()->json(['status' => 'success', 'message' => 'Concern Updated Successfully !']);

        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VendorConcern  $vendorConcern
     * @return \Illuminate\Http\Response
     */
    public function destroy(VendorConcern $vendorConcern)
    {
        try {
            $vendorConcern->delete();

            return response()->json(['status' => 'success', 'message' => 'vendor Concern Deleted']);
            
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
