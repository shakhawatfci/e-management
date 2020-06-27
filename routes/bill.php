<?php
// all route are registered in route service provider this route holding bill and pyament related function
Route::resource('bill','Bill\BillController');
Route::get('billing-and-payment','Bill\BillController@billingPage')->name('billing.payment');
Route::get('bill-list','Bill\BillController@billList');

// project payment 

Route::resource('project-payment','ProjectPaymentController');

