<?php 
//vendor

Route::resource('supplier','Supplier\VendorController');
Route::get('supplier-list','Supplier\VendorController@supplierList');
Route::post('supplier/status',['as'=>'supplier.status','uses'=>'Supplier\VendorController@destroy']);