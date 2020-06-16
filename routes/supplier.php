<?php 
//vendor

Route::resource('our-vendor','Supplier\VendorController');
Route::post('our-vendor/status',['as'=>'vendor.status','uses'=>'Supplier\VendorController@destroy']);