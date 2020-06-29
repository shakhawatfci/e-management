<?php
// all route are registered in route service provider this route holding bill and pyament related function
Route::resource('bill','Bill\BillController');
Route::get('billing-and-payment','Bill\BillController@billingPage')->name('billing.payment');
Route::get('bill-list','Bill\BillController@billList');

Route::get('bill-print/{bill_no}','Bill\BillController@printForm')->name('bill-print-form');

Route::get('bill-print','Bill\BillController@billPrint')->name('bill.print');

// project payment 

Route::resource('project-payment','ProjectPaymentController');

