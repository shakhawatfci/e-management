<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employee;
use App\EmployeeEducation;
use App\EmployeeExperience;
use App\EmployeeSalary;
use App\User;
use App\Role;
use Auth;
use Image;
use Hash;
use DB;
 

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // role 
        $role = Role::orderBy('role_name','asc')->get();
        return view('employee.employee',['roles' => $role]);
    }

    public function employeeList(Request $request)
    {
        $employee = Employee::with(['user.role','employee_education','employee_experience'])
                             ->orderBy('name','asc');
       
       if($request->keyword != '')
       {
           $employee->where('name','LIKE','%'.$request->keyword.'%')
                     ->orWhere('designation','LIKE','%'.$request->keyword.'%')
                     ->orWhere('salary','LIKE','%'.$request->keyword.'%')
                     ->orWhere('phone','LIKE','%'.$request->keyword.'%')
                     ->orWhere('email','LIKE','%'.$request->keyword.'%');
       }

       $employee = $employee->paginate(10);

       return $employee;
    }

    public function allEmployee()
    {
        return Employee::orderBy('name','desc')->get();
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
          'name'                                 =>    'required',
          'email'                                =>    'email|required|unique:employees',
          'role_id'                              =>    'required',
          'password'                             =>    'required|confirmed',
          'phone'                                =>    'required',
          'designation'                          =>    'required',
          'date_of_birth'                        =>    'required',
          'date_of_joining'                      =>    'required',
          'image'                                =>    'nullable|image64:jpg,png,gif,jpeg',
          'salary'                               =>    'required|regex:/^[0-9]+(\.[0-9]{1,10})?$/',
          'employee_education.*.institute'       =>    'sometimes|required',
          'employee_education.*.board'           =>    'sometimes|required',
          'employee_education.*.degree'          =>    'sometimes|required',
          'employee_education.*.passing_year'    =>    'sometimes|required',
          'employee_education.*.result'          =>    'sometimes|required',
          'employee_education.*.gpa'             =>    'sometimes|required',
          'employee_experience.*.organization'   =>    'sometimes|required',
          'employee_experience.*.designation'    =>    'sometimes|required',
          'employee_experience.*.from_date'      =>    'sometimes|required',
          'employee_experience.*.to_date'        =>    'sometimes|required',
          'employee_experience.*.responsibility' =>    'sometimes|required',
          'employee_experience.*.skill'          =>    'sometimes|required',
        ],[
            'employee_education.*.institute'       =>    'field is Required',
            'employee_education.*.board'           =>    'field is Required',
            'employee_education.*.degree'          =>    'field is Required',
            'employee_education.*.passing_year'    =>    'field is Required',
            'employee_education.*.result'          =>    'field is Required',
            'employee_education.*.gpa'             =>    'field is Required',
            'employee_experience.*.organization'   =>    'field is Required',
            'employee_experience.*.designation'    =>    'field is Required',
            'employee_experience.*.from_date'      =>    'field is Required',
            'employee_experience.*.to_date'        =>    'field is Required',
            'employee_experience.*.responsibility' =>    'field is Required',
            'employee_experience.*.skill'          =>    'field is Required'
        ]);
       
        try
        {
           
            DB::beginTransaction();
            
            // add employee 
            $employee                     =   new Employee;
            $employee->name               =   $request->name;
            $employee->email              =   $request->email;
            $employee->phone              =   $request->phone;
            $employee->designation        =   $request->designation;
            $employee->date_of_birth      =   $request->date_of_birth;
            $employee->date_of_joining    =   $request->date_of_joining;
            $employee->salary             =   $request->salary;
            $employee->address            =   $request->address;
            $employee->emargency_contact  =   $request->emargency_contact;
            $employee->status             =   $request->status;

            $imageData = $request->get('image');
         
            if($imageData)
            {
             
             $fileName = uniqid().'.'.explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
             Image::make($request->get('image'))->save('images/employee/'.$fileName);
   
             $employee->image = $fileName;

   
            }
   
            $employee->save();
            
            // creating user name  for employee 
            $user                =    new User;
            $user->name          =    $request->name;
            $user->email         =    $request->email;
            $user->role_id       =    $request->role_id;
            $user->employee_id   =    $employee->id;
            $user->password      =    Hash::make($request->password);
            $user->save();

            // insert employee education 

            if($request->employee_education)
            {
                foreach($request->employee_education as $edu)
                {
                  $education = new EmployeeEducation;
                  $education->employee_id    =    $employee->id;
                  $education->institute      =    $edu['institute'];
                  $education->board          =    $edu['board'];
                  $education->degree         =    $edu['degree'];
                  $education->result         =    $edu['result'];
                  $education->passing_year   =    $edu['passing_year'];
                  $education->gpa            =    $edu['gpa'];
                  $education->save();
                }
            }


            // insert employee experience 

            if($request->employee_experience)
            {
                foreach($request->employee_experience as $exp)
                {
                  $experience = new EmployeeExperience;
                  $experience->organization     =    $exp['organization'];
                  $experience->designation      =    $exp['designation'];
                  $experience->from_date        =    $exp['from_date'];
                  $experience->to_date          =    $exp['to_date'];
                  $experience->responsibility   =    $exp['responsibility'];
                  $experience->skill            =    $exp['skill'];
                  $experience->employee_id      =    $employee->id;
                  $experience->save(); 
                }
            }

            DB::commit();

            return response()->json(['status'=>'success','message' => 'Employee Added']);

        }
        catch(\Exception $e)
        {
         
          DB::rollback();
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
            'name'                                 =>    'required',
            'email'                                =>    'email|required|unique:employees,email,'.$id,
            'role_id'                              =>    'required',
            'phone'                                =>    'required',
            'designation'                          =>    'required',
            'date_of_birth'                        =>    'required',
            'date_of_joining'                      =>    'required',
            'photo'                                =>    'nullable|image64:jpg,png,gif,jpeg',
            'salary'                               =>    'required|regex:/^[0-9]+(\.[0-9]{1,10})?$/',
            'employee_education.*.institute'       =>    'sometimes|required',
            'employee_education.*.board'           =>    'sometimes|required',
            'employee_education.*.degree'          =>    'sometimes|required',
            'employee_education.*.passing_year'    =>    'sometimes|required',
            'employee_education.*.result'          =>    'sometimes|required',
            'employee_education.*.gpa'             =>    'sometimes|required',
            'employee_experience.*.organization'   =>    'sometimes|required',
            'employee_experience.*.designation'    =>    'sometimes|required',
            'employee_experience.*.from_date'      =>    'sometimes|required',
            'employee_experience.*.to_date'        =>    'sometimes|required',
            'employee_experience.*.responsibility' =>    'sometimes|required',
            'employee_experience.*.skill'          =>    'sometimes|required',
          ]);
         
          try
          {
             
              DB::beginTransaction();
              
              // add employee 
              $employee                            =     Employee::find($id);
              $employee->name                      =     $request->name;
              $employee->email                     =     $request->email;
              $employee->phone                     =     $request->phone;
              $employee->designation               =     $request->designation;
              $employee->date_of_birth             =     $request->date_of_birth;
              $employee->date_of_joining           =     $request->date_of_joining;
              $employee->salary                    =     $request->salary;
              $employee->address                   =     $request->address;
              $employee->emargency_contact         =     $request->emargency_contact;
              $employee->status                    =     $request->status;
  
              $imageData                           =     $request->get('photo');
           
              if($imageData)
              {

               if(file_exists('images/employee/'.$employee->image) && !empty($employee->image))
               {
                  unlink('images/employee/'.$employee->image);
               }

               $fileName = uniqid().'.'.explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
               Image::make($request->get('photo'))->save('images/employee/'.$fileName);
     
               $employee->image = $fileName;
  
     
              }
     
              $employee->update();
              
              // creating user name  for employee 
              $user                =    User::find($request->user['id']);
              $user->name          =    $request->name;
              $user->email         =    $request->email;
              $user->role_id       =    $request->role_id;
              $user->update();
  
              // insert employee education 
              
            //   detle before insert 

              EmployeeEducation::where('employee_id','=',$id)->delete();
              if($request->employee_education)
              {
                  foreach($request->employee_education as $edu)
                  {
                    $education = new EmployeeEducation;
                    $education->employee_id    =    $id;
                    $education->institute      =    $edu['institute'];
                    $education->board          =    $edu['board'];
                    $education->degree         =    $edu['degree'];
                    $education->result         =    $edu['result'];
                    $education->passing_year   =    $edu['passing_year'];
                    $education->gpa            =    $edu['gpa'];
                    $education->save();
                  }
              }
  
  
              // insert employee experience 


              //   detle before insert 

              EmployeeExperience::where('employee_id','=',$id)->delete();

              if($request->employee_experience)
              {
                  foreach($request->employee_experience as $exp)
                  {
                    $experience = new EmployeeExperience;
                    $experience->organization     =    $exp['organization'];
                    $experience->designation      =    $exp['designation'];
                    $experience->from_date        =    $exp['from_date'];
                    $experience->to_date          =    $exp['to_date'];
                    $experience->responsibility   =    $exp['responsibility'];
                    $experience->skill            =    $exp['skill'];
                    $experience->employee_id      =    $id;
                    $experience->save(); 
                  }
              }
  
              DB::commit();
  
              return response()->json(['status'=>'success','message' => 'Employee Information Updated']);
  
          }
          catch(\Exception $e)
          {
           
            DB::rollback();
            return response()->json(['status'=>'error','message'=>$e->getMessage()]);
  
          }
    }

    // employee password change

    public function changePassword(Request $request)
    {
        $request->validate(
            [
                'password' => 'required|confirmed'
            ]
            );
       try
       {
        $password =  Hash::make($request->password);

        User::where('employee_id','=',$request->employee_id)->update(
            [
                'password' => $password,
            ]
            );

            return response()->json(['status'=>'success','message'=>'Password Changed']);

       }
       catch(\Exception $e)
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
        $check_salary = EmployeeSalary::where('employee_id','=',$id)->count();
        if($check_salary > 0)
        {
           
            return response()->json(['status' => 'error' , 'message' => 'Employee Having Data in Others table']);

        }

        try {
            //code...
            DB::beginTransaction();
            // delete education 
            EmployeeEducation::where('employee_id','=',$id)->delete();
            EmployeeExperience::where('employee_id','=',$id)->delete();
            User::where('employee_id','=',$id)->delete();
            $employee = Employee::find($id);
            if(file_exists('images/employee/'.$employee->image) && !empty($employee->image))
            {
               unlink('images/employee/'.$employee->image);
            }
            $employee->delete();

            DB::commit();
            return response()->json(['status' => 'success','message' => 'Employee Deleted']);
            
        } 
        catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            return response()->json(['status' => 'success','message' => $e->getMessage()]);
        }
    }
}
