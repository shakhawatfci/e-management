<?php

// employee related data 

Route::resource('employee','Employee\EmployeeController');
Route::get('employee-list','Employee\EmployeeController@employeeList');
Route::get('all-employee','Employee\EmployeeController@allEmployee');

Route::resource('employee-salary','Employee\EmployeeSalaryController');

Route::get('employee-salary-list','Employee\EmployeeSalaryController@salaryList');
Route::get('employee-salary-print-pdf','Employee\EmployeeSalaryController@salaryListPrint');

Route::post('employee-password','Employee\EmployeeController@changePassword');