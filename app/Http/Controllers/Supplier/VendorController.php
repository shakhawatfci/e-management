<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Vendor;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('supplier.supplier');
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
        try {
            $request->validate([
                'vendor_name'=>'required',
                'vendor_address'=>'required',
                'vendor_phone'=>'required'
            ]);

          $vendor = Vendor::create($request->all());

          return response()->json(['status' => 'success', 'message' => 'Vendor Created Successfully !']);
            
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

    public function supplierList(Request $request)
    {
        $vendor = Vendor::orderBy('id','desc');
        if($request->keyword != '')
        {
           $vendor->where('vendor_name','LIKE','%'.$request->keyword.'%');
           $vendor->orWhere('vendor_address','LIKE','%'.$request->keyword.'%');
           $vendor->orWhere('vendor_phone','LIKE','%'.$request->keyword.'%');
        }
        $vendor = $vendor->get();
        return $vendor;
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
        try {
            $request->validate([
                'vendor_name'=>'required',
                'vendor_address'=>'required',
                'vendor_phone'=>'required'
            ]);

            $vendor = Vendor::find($request->id);
            $vendor->vendor_name = $request->vendor_name;
            $vendor->vendor_address = $request->vendor_address;
            $vendor->vendor_email = $request->vendor_email;
            $vendor->vendor_phone = $request->vendor_phone;
            $vendor->update();

          return response()->json(['status' => 'success', 'message' => 'Vendor Updated Successfully !']);
            
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
        //
    }
}
