<?php 
//vendor

Route::resource('supplier','Supplier\VendorController');
Route::get('supplier-list','Supplier\VendorController@supplierList');
Route::get('supplier-list-print-pdf','Supplier\VendorController@supplierListPrintPdf');

//Concern
Route::resource('project-concern','ProjectConcernController');
Route::get('project-concern-list','ProjectConcernController@projectConcernList');

Route::resource('vendor-concern','VendorConcernController');
Route::get('vendor-concern-list','VendorConcernController@vendorConcernList');