<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\Report\Report;
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


}