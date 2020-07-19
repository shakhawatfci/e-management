<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employee;
use App\EmployeeSalary;
use DB;


class EmployeeSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employee.salary');
    }

    public function salaryList(Request $request)
    {

      $per_page = 10;
      $salary = EmployeeSalary::with(['employee:id,name'])
                             ->orderBy('month','desc')
                             ->orderBy('updated_at','desc');

      if($request->employee_id != '')
      {
        $salary->where('employee_id','=',$request->employee_id);
      }

      $salary = $salary->paginate($per_page);

      return $salary;
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
        $request->validate([
            'employee_id'           =>   'required',
            'month'                 =>   'required',
            'date'                  =>   'required',
            'salary_amount'         =>   'required|gt:0|regex:/^[0-9]+(\.[0-9]{1,10})?$/',
            'bonus'                 =>   'nullable|regex:/^[0-9]+(\.[0-9]{1,10})?$/',
            'deduction'             =>   'nullable|regex:/^[0-9]+(\.[0-9]{1,10})?$/',
            'total_salary_amount'   =>   'required|gt:0|regex:/^[0-9]+(\.[0-9]{1,10})?$/',
        ]);

        try
        {
            $month = date('Y-m',strtotime($request->month));

           $count_double_salary = EmployeeSalary::where('employee_id','=',$request->employee_id)
                                                  ->where('month','=',$month)
                                                  ->count();

            if($count_double_salary > 0) 
            {
                return response()->json(['status'=>'error','message'=>'Already Salary Given in this month']);
            }                                      
         
            $salary = new EmployeeSalary;
            $salary->employee_id           =      $request->employee_id;
            $salary->month                 =      $month;
            $salary->date                  =      $request->date;
            $salary->salary_amount         =      $request->salary_amount;
            $salary->bonus                 =      $request->bonus;
            $salary->deduction             =      $request->deduction;
            $salary->total_salary_amount   =      $request->total_salary_amount;
            $salary->bonus_reason          =      $request->bonus_reason;
            $salary->deduction_reason      =      $request->deduction_reason;
            $salary->salary_note           =      $request->salary_note;
            $salary->status                =      1;
            $salary->save();

            return response()->json(['status'=>'success','message'=>'Employee Salary Created!']);

        }
        catch(\Exceptoin $e)
        {
            return response()->json(['status'=>'error','message'=>$e->getMessage()]);
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
            'employee_id'           =>   'required',
            'month'                 =>   'required',
            'date'                  =>   'required',
            'salary_amount'         =>   'required|gt:0|regex:/^[0-9]+(\.[0-9]{1,10})?$/',
            'bonus'                 =>   'nullable|regex:/^[0-9]+(\.[0-9]{1,10})?$/',
            'deduction'             =>   'nullable|regex:/^[0-9]+(\.[0-9]{1,10})?$/',
            'total_salary_amount'   =>   'required|gt:0|regex:/^[0-9]+(\.[0-9]{1,10})?$/',
        ]);

        try
        {     
            $month = date('Y-m',strtotime($request->month));                          
         
            $salary =  EmployeeSalary::find($id);
            $salary->employee_id           =      $request->employee_id;
            $salary->month                 =      $month;
            $salary->date                  =      $request->date;
            $salary->salary_amount         =      $request->salary_amount;
            $salary->bonus                 =      $request->bonus;
            $salary->deduction             =      $request->deduction;
            $salary->total_salary_amount   =      $request->total_salary_amount;
            $salary->bonus_reason          =      $request->bonus_reason;
            $salary->deduction_reason      =      $request->deduction_reason;
            $salary->salary_note           =      $request->salary_note;
            $salary->status                =      1;
            $salary->update();

            return response()->json(['status'=>'success','message'=>'Employee Salary Updated!']);

        }
        catch(\Exceptoin $e)
        {
            return response()->json(['status'=>'error','message'=>$e->getMessage()]);
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
          $salary = EmployeeSalary::find($id);
          $salary->delete();
          return response()->json(['status'=>'success','message'=>'Salary Deleted']);
        }
        catch(\Exception $e)
        {
         
          return response()->json(['status'=>'error','message'=>$e->getMessage()]);

        }
    }
}
