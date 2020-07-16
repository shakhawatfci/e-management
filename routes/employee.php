<?php

// employee related data 

Route::resource('employee','Employee\EmployeeController');
Route::get('employee-list','Employee\EmployeeController@employeeList');
Route::get('employee-salary','Employee\EmployeeController@employeeSalary')->name('employee-salary.index');

Route::post('employee-password','Employee\EmployeeController@changePassword');