<?php 
//vendor

Route::resource('supplier','Supplier\VendorController');
Route::get('supplier-list','Supplier\VendorController@supplierList');