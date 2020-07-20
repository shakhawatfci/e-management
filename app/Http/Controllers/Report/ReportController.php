<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProjectClaim;
use App\EmployeeSalary;
use App\EquipmentExpense;
use App\OfficeExpense;
use App\ProjectExpense;
use App\EquipmentSales;
use DB;
use Auth;

class ReportController extends Controller
{
    // get to montly report page 

    public function  montlyReportPage()
    {

    
        return view('report.monthly');
    }

    public function monthlyReportResult(Request $request)
    {
        $month_from = '2019-01';
        $month_to   = '2020-09';

        $query = "SELECT pc.month , COALESCE(SUM(pc.total_project_amount),0) AS total_project_bill_amount,
         COALESCE(SUM(pc.total_vendor_amount),0) AS total_vendor_bill_amount,
         COALESCE(SUM(pc.vendor_payment),0) AS vendor_payment,
         COALESCE(SUM(pc.project_payment),0) AS project_payment,
         COALESCE(SUM(pc.project_adjustment_payment),0) AS project_adjustment,
         COALESCE(SUM(pc.vendor_adjustment_payment),0) AS vendor_adjustment,
         COALESCE(SUM(project_payment)+SUM('project_adjustment'),0) AS total_project_payment,
         COALESCE(SUM(vendor_payment)+SUM('vendor_adjustment'),0) AS total_vendor_payment,
        (SELECT COALESCE(SUM(total_salary_amount), 0) AS salary FROM employee_salaries WHERE month = pc.month)
         AS employee_salary_amount,
        (SELECT COALESCE(SUM(payment_amount), 0) AS emp_salary FROM operator_salaries WHERE month = pc.month)
         AS operator_salary_amount,
        (SELECT COALESCE(SUM(amount), 0) AS eq_exp FROM equipement_expense WHERE month = pc.month)
         AS equipment_expense_amount,
        (SELECT COALESCE(SUM(amount), 0) AS of_exp FROM office_expenses WHERE month = pc.month)
         AS office_expense_amount,
        (SELECT COALESCE(SUM(amount), 0) AS pr_exp FROM project_expenses WHERE month = pc.month)
         AS project_expense_amount,
        (SELECT COALESCE(SUM(profit), 0) AS eq_sale FROM equipment_sales WHERE month = pc.month)
         AS equipment_sales_profit_amount,
        (SELECT COALESCE(SUM(profit), 0) AS eq_sale FROM mobilizations WHERE month = pc.month)
         AS mobilization_profit_amount
        FROM project_claim AS pc 
        WHERE pc.month BETWEEN '$month_from' AND '$month_to'  GROUP BY pc.month ORDER BY pc.month ASC";

        $data    =  DB::select($query);

        return $data;

    }


}
