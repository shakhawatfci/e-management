<?php

namespace App\Http\Controllers\Bill;

use App\AllStatic;
use App\CarAssign;
use App\EquipmentType;
use App\Http\Controllers\Controller;
use App\Operator;
use App\Project;
use App\ProjectClaim;
use App\ProjectPayment;
use App\Vendor;
use App\VendorPayment;
use Auth;
use DB;
use Illuminate\Http\Request;
use PDF;

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
            'projects' => $project,
            'vendors' => $vendor,
            'equipment_types' => $equipment_type,
            'operators' => $operator,
        ]);

    }

    public function billingPage()
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

        return view('bill.bill_payment', [
            'projects' => $project,
            'vendors' => $vendor,
            'equipment_types' => $equipment_type,
            'operators' => $operator,
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

        // validate bill before submiting

        $request->validate([
            'month' => 'required',
            'date' => 'required',
            'total_hour' => 'required',
            'project_rate_per_hour' => 'required|gt:0|regex:/^[0-9]+(\.[0-9]{1,10})?$/',
            'vendor_rate_per_hour' => 'nullable|regex:/^[0-9]+(\.[0-9]{1,10})?$/',
            'project_amount' => 'required|gt:0|regex:/^[0-9]+(\.[0-9]{1,10})?$/',
            'vendor_amount' => 'required|gt:0|regex:/^[0-9]+(\.[0-9]{1,10})?$/',
            'total_project_amount' => 'required|gt:0|regex:/^[0-9]+(\.[0-9]{1,10})?$/',
            'total_vendor_amount' => 'required|gt:0|regex:/^[0-9]+(\.[0-9]{1,10})?$/',
            'project_vat' => 'nullable|regex:/^[0-9]+(\.[0-9]{1,10})?$/',
            'project_ait' => 'nullable|regex:/^[0-9]+(\.[0-9]{1,10})?$/',
            'project_sup' => 'nullable|regex:/^[0-9]+(\.[0-9]{1,10})?$/',
            'vendor_vat' => 'nullable|regex:/^[0-9]+(\.[0-9]{1,10})?$/',
            'vendor_ait' => 'nullable|regex:/^[0-9]+(\.[0-9]{1,10})?$/',
            'vendor_sup' => 'nullable|regex:/^[0-9]+(\.[0-9]{1,10})?$/',
        ]);

        try
        {

            DB::beginTransaction();
            //   checking this equipment already having bill in this month
            $count_bill = ProjectClaim::where('assign_id', '=', $request->id)
                ->where('month', '=', $request->month)
                ->count();

            if ($count_bill) {
                return response()->json(['status' => 'error', 'message' => 'This Equipment Already Having Bill in this month']);
            }

            $assign = CarAssign::find($request->assign_id);

            $bill = new ProjectClaim;
            $bill_no = generateBillNo($request->month);
            $bill->bill_no = $bill_no;
            $bill->assign_id = $request->assign_id;
            $bill->project_id = $assign->project_id;
            $bill->vendor_id = $assign->vendor_id;
            $bill->equipment_type_id = $assign->equipment_type_id;
            $bill->equipement_id = $assign->equipement_id;
            $bill->user_id = Auth::user()->id;
            $bill->month = $request->month;
            $bill->date = $request->date;
            $bill->total_hour = $request->total_hour;
            $bill->project_rate_per_hour = $request->project_rate_per_hour;
            $bill->vendor_rate_per_hour = $request->vendor_rate_per_hour;
            $bill->project_amount = $request->project_amount;
            $bill->vendor_amount = $request->vendor_amount;
            $bill->project_vat = $request->project_vat;
            $bill->project_ait = $request->project_ait;
            $bill->project_sup = $request->project_sup;
            $bill->vendor_vat = $request->vendor_vat;
            $bill->vendor_ait = $request->vendor_ait;
            $bill->vendor_sup = $request->vendor_sup;
            $bill->total_project_amount = $request->total_project_amount;
            $bill->total_vendor_amount = $request->total_vendor_amount;
            $bill->documents_link = $request->documents_link;
            $bill->save();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'print_status' => $request->print_status,
                'bill_no' => $bill_no,
                'message' => 'Bill Generated',
            ]);

        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function billList(Request $request)
    {
        $per_page = 10;

        if ($request->per_page > 0) {
            $per_page = $request->per_page;
        }

        $bill = ProjectClaim::with([

            'equipement',
            'equipment_type:id,name',
            'vendor:id,vendor_name',
            'project:id,project_name',
        ])->orderBy('updated_at', 'desc');

        if ($request->bill_no != '') {
            $bill->where('bill_no', 'LIKE', '%' . $request->bill_no . '%');
        }

        if ($request->project_id != '') {
            $bill->where('project_id', '=', $request->project_id);
        }

        if ($request->month != '') {
            $bill->where('month', '=', $request->month);
        }

        if ($request->vendor_id != '') {
            $bill->where('vendor_id', '=', $request->vendor_id);
        }

        if ($request->equipment_id != '') {
            $bill->where('equipement_id', '=', $request->equipment_id);
        }

        if ($request->equipment_type_id != '') {
            $bill->where('equipment_type_id', '=', $request->equipment_type_id);
        }

        $bill = $bill->paginate($per_page);

        return $bill;
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
        // validate bill before submiting

        $request->validate([
            'month' => 'required',
            'date' => 'required',
            'total_hour' => 'required',
            'project_rate_per_hour' => 'required|gt:0|regex:/^[0-9]+(\.[0-9]{1,10})?$/',
            'vendor_rate_per_hour' => 'nullable|regex:/^[0-9]+(\.[0-9]{1,10})?$/',
            'project_amount' => 'required|gt:0|regex:/^[0-9]+(\.[0-9]{1,10})?$/',
            'vendor_amount' => 'required|gt:0|regex:/^[0-9]+(\.[0-9]{1,10})?$/',
            'total_project_amount' => 'required|gt:0|regex:/^[0-9]+(\.[0-9]{1,10})?$/',
            'total_vendor_amount' => 'required|gt:0|regex:/^[0-9]+(\.[0-9]{1,10})?$/',
            'project_vat' => 'nullable|regex:/^[0-9]+(\.[0-9]{1,10})?$/',
            'project_ait' => 'nullable|regex:/^[0-9]+(\.[0-9]{1,10})?$/',
            'project_sup' => 'nullable|regex:/^[0-9]+(\.[0-9]{1,10})?$/',
            'vendor_vat' => 'nullable|regex:/^[0-9]+(\.[0-9]{1,10})?$/',
            'vendor_ait' => 'nullable|regex:/^[0-9]+(\.[0-9]{1,10})?$/',
            'vendor_sup' => 'nullable|regex:/^[0-9]+(\.[0-9]{1,10})?$/',
        ]);

        try
        {

            DB::beginTransaction();

            $bill = ProjectClaim::find($id);
            $bill->user_id = Auth::user()->id;
            $bill->month = $request->month;
            $bill->date = $request->date;
            $bill->total_hour = $request->total_hour;
            $bill->project_rate_per_hour = $request->project_rate_per_hour;
            $bill->vendor_rate_per_hour = $request->vendor_rate_per_hour;
            $bill->project_amount = $request->project_amount;
            $bill->vendor_amount = $request->vendor_amount;
            $bill->project_vat = $request->project_vat;
            $bill->project_ait = $request->project_ait;
            $bill->project_sup = $request->project_sup;
            $bill->vendor_vat = $request->vendor_vat;
            $bill->vendor_ait = $request->vendor_ait;
            $bill->vendor_sup = $request->vendor_sup;
            $bill->total_project_amount = $request->total_project_amount;
            $bill->total_vendor_amount = $request->total_vendor_amount;
            if ($request->total_project_amount > $bill->project_payment + $bill->project_adjustment_amount) {
                $bill->payment_status = 0;
            }
            if ($request->total_vendor_amount > $bill->project_payment + $bill->project_adjustment_amount) {
                $bill->vendor_payment_status = 0;
            }
            $bill->documents_link = $request->documents_link;
            $bill->update();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'print_status' => $request->print_status,
                'bill_no' => $bill->bill_no,
                'message' => 'Bill Updated',
            ]);

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
        try
        {
            $project_payment = ProjectPayment::where('project_claim_id', '=', $id)->count();
            $vendor_payment = VendorPayment::where('project_claim_id', '=', $id)->count();

            //   if there is any payment rearding this claim admin should have to delete those payment first
            if ($project_payment > 0 || $vendor_payment > 0) {
                return response()->json(['status' => 'error', 'message' => 'Unable to delete due to it\'s 
                having payment please delete those payment first']);
            }

            $project_claim = ProjectClaim::find($id);

            $project_claim->delete();

            return response()->json(['status' => 'success', 'message' => 'Bill Deleted Successfully']);

        } catch (\Exception $e) {

            return response()->json(['status' => 'error', 'message' => 'Soomething Went Wrong!']);

        }
        // $chekc it's having any payment or not

    }

    public function printForm($bill_no)
    {

        $bill = ProjectClaim::with(
            [
                'equipement',
                'equipment_type',
                'vendor',
                'project',
            ]
        )
            ->where('bill_no', '=', $bill_no)
            ->first();

        if ($bill) {

            return view('bill.print.print_input', ['bill' => $bill]);

        } else {
            return redirect()->back();
        }

    }

    public function billPrint(Request $request)
    {

        $bill = ProjectClaim::where('bill_no', '=', $request->bill_no)->first();

        if ($request->action == 'print') {
            return view('bill.print.print', [
                'bill' => $bill,
                'form_data' => $request->all(),
            ]);
        } else {
            $pdf = PDF::loadView('bill.pdf.bill_pdf', [
                'bill' => $bill,
                'form_data' => $request->all(),
            ]);

            $pdf->setPaper('A4', 'landscape');
            $pdf_name = "bill-" . $bill->bill_no . ".pdf";
            return $pdf->download($pdf_name);
        }

    }
}
