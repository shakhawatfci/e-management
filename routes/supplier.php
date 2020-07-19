<?php 
//vendor

Route::resource('supplier','Supplier\VendorController');
Route::get('supplier-list','Supplier\VendorController@supplierList');
Route::get('supplier-list-print-pdf','Supplier\VendorController@supplierListPrintPdf');