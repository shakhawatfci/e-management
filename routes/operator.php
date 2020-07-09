<?php

// Operator
Route::resource('operator','Operator\OperatorController');
Route::get('operator-list','Operator\OperatorController@operatorList');
Route::post('operator-update/{id}','Operator\OperatorController@update');

// Operator Salary
Route::resource('operator-salary','Operator\OperatorSalaryController');
Route::get('operator-salary-list','Operator\OperatorSalaryController@operatorSalaryList');