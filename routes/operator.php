<?php

// Operator
Route::resource('operator','Operator\OperatorController');
Route::get('operator-list','Operator\OperatorController@operatorList');
Route::post('operator-update/{id}','Operator\OperatorController@update');
Route::get('operator-list-print-pdf','Operator\OperatorController@operatorListPrint');

// Operator Salary
Route::resource('operator-salary','Operator\OperatorSalaryController');
Route::get('operator-salary-list','Operator\OperatorSalaryController@operatorSalaryList');
Route::get('operator-salary-print-pdf','Operator\OperatorSalaryController@operatorSalaryPrint');

// Operator Fooding
Route::resource('operator-fooding','Operator\OperatorFoodingController');
Route::get('operator-fooding-list','Operator\OperatorFoodingController@operatorFoodingList');
Route::get('operator-fooding-print-pdf','Operator\OperatorFoodingController@operatorFoodingPrint');
Route::get('operator-fooding-list-pdf/print','Operator\OperatorFoodingController@operatorFoodingListPrint');
Route::get('operator-fooding-payment-list-pdf/print','Operator\OperatorFoodingController@operatorFoodingPaymentPrint');

Route::get('operator-fooding-payment/project/{project_id}/equipment/{equipment_id}','Operator\OperatorFoodingController@operatorFoodingPayment');