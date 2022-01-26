<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\Report\Report;
use App\Vendor;
use App\Project;
use App\EquipmentType;
use App\Equipement;
use DB;
use Auth;

class ReportController extends Controller
{
    private $report;

    public function __construct()
    {

        $this->report = new Report;

    }
    // get to monthly report page 

    public function  montlyReportPage()
    {

    
        return view('report.monthly');
    }


    // get monthly report 


    public function monthlyReportResult(Request $request)
    {

        $month_from    =   date('Y-m',strtotime(str_replace('/','-',$request->month_from)));
        $month_to      =   date('Y-m',strtotime(str_replace('/','-',$request->month_to)));
        
        return $this->report->getMonthlyReport($month_from,$month_to); 

    }

    public function monthlyReportPrint(Request $request)
    {

        $month_from    =   date('Y-m',strtotime(str_replace('/','-',$request->month_from)));
        $month_to      =   date('Y-m',strtotime(str_replace('/','-',$request->month_to)));
        
        $data = $this->report->getMonthlyReport($month_from,$month_to);
        if($request->action == 'print')
        {
            return view('report.print.monthly_report_print',['report_data' => $data,'request_to' => [$month_from,$month_to]]);
        } else {
            // return view('report.pdf.equipment_report_invoice_pdf',['equipment' => $invoice_data,'report_category' => $category_data]);
            $pdf = \PDF::loadView('report.pdf.monthly_report_pdf',['report_data' => $data,'request_to' => [$month_from,$month_to]]);

            $pdf->setPaper('A4', 'landscape');
            $pdf_name = "monthly_report-list.pdf";
            return $pdf->download($pdf_name);
        }

    }

    // getting to the equipment wise  report page 

    public function equipmentWiseReportPage()
    {
        $vendor         = Vendor::orderBy('vendor_name','asc')->get();
        $equipment_type = EquipmentType::orderBy('name','asc')->get();
        return view('report.equipment_wise',[
            'vendors'         => $vendor,
            'equipment_types' => $equipment_type,
        ]);

    }


    // getting result form report repo

    public function equipmentlyReportResult(Request $request)
    {
        $month_from    =   date('Y-m',strtotime(str_replace('/','-',$request->month_from)));
        $month_to      =   date('Y-m',strtotime(str_replace('/','-',$request->month_to)));
        
        return $this->report->getEquipmentWiseReport($month_from,$month_to,$request->equipment_type_id,$request->vendor_id,$request->equipment_id); 
    }

    public function equipmentWiseReportPrint(Request $request)
    {

        $month_from    =   date('Y-m',strtotime(str_replace('/','-',$request->month_from)));
        $month_to      =   date('Y-m',strtotime(str_replace('/','-',$request->month_to)));
        $equipment       =   Equipement::find($request->equipment_id);
        $data = $this->report->getEquipmentWiseReport($month_from,$month_to,$request->equipment_type_id,$request->vendor_id,$request->equipment_id);

        if($request->action == 'print')
        {
            return view('report.print.equipment_wise_report_print',['report_data' => $data,'request_to' => [$month_from,$month_to],'equipment' => $equipment]);
        } else {
            $pdf = \PDF::loadView('report.pdf.equipment_wise_report_pdf',['report_data' => $data,'request_to' => [$month_from,$month_to],'equipment' => $equipment]);

            $pdf->setPaper('A4', 'landscape');
            $pdf_name = "equipment_wise_report-list.pdf";
            return $pdf->download($pdf_name);
        }

    }


    public function projectWiseReportPage()
    {
        $projects = Project::select('id','project_name')
                            ->orderBy('project_name','desc')
                            ->get();
       
        return view('report.project_wise',['projects' => $projects]);

    }

    public function projectlyReportResult(Request $request)
    {
        $month_from    =   date('Y-m',strtotime(str_replace('/','-',$request->month_from)));
        $month_to      =   date('Y-m',strtotime(str_replace('/','-',$request->month_to)));

        return $this->report->getProjectWiseReport($month_from,$month_to,$request->project_id);
    }

    public function projectWiseReportPrint(Request $request)
    {

        $month_from    =   date('Y-m',strtotime(str_replace('/','-',$request->month_from)));
        $month_to      =   date('Y-m',strtotime(str_replace('/','-',$request->month_to)));
        $project       =   Project::find($request->project_id);
        $data = $this->report->getProjectWiseReport($month_from,$month_to,$request->project_id);
        if($request->action == 'print')
        {
            return view('report.print.project_wise_report_print',['report_data' => $data,'request_to' => [$month_from,$month_to],'project' => $project]);
        } else {
            $pdf = \PDF::loadView('report.pdf.project_wise_report_pdf',['report_data' => $data,'request_to' => [$month_from,$month_to],'project' => $project]);

            $pdf->setPaper('A4', 'landscape');
            $pdf_name = "project_wise_report-list.pdf";
            return $pdf->download($pdf_name);
        }

    }

}
