<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\Report\Report;
use App\Vendor;
use App\Project;
use App\EquipmentType;
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


}
