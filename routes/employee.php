<?php

// employee related data 

Route::resource('employee','Employee\EmployeeController');

Route::get('employee-list','Employee\EmployeeController@employeeList');