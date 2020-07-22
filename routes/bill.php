<?php
// all route are registered in route service provider this route holding bill and pyament related function
Route::resource('bill','Bill\BillController');
Route::get('billing-and-payment','Bill\BillController@billingPage')->name('billing.payment');
Route::get('bill-list','Bill\BillController@billList');

Route::get('bill-print/{bill_no}','Bill\BillController@printForm')->name('bill-print-form');

Route::get('bill-print','Bill\BillController@billPrint')->name('bill.print');

Route::get('bill-list-pdf/print','Bill\BillController@billListPdfPrint');

// project payment 

Route::resource('project-payment','ProjectPaymentController');
Route::resource('vendor-payment','VendorPaymentController');

// equipment  sales

Route::resource('equipment-sales','EquipmentSalesController');

Route::get('equipment-sales-list','EquipmentSalesController@equipmentSalesList');


// equipment  sales

Route::resource('mobilization','MobilizationController');

Route::get('mobilization-list','MobilizationController@mobilzationList');


