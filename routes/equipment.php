<?php

use Illuminate\Support\Facades\Route;

// equipment and equipment auth related info 

// equipment type 

Route::resource('equipment-type','Equipment\EquipmentTypeController');
Route::get('equipment-category-list','Equipment\EquipmentTypeController@equipmentTypeList');

Route::resource('equipment','Equipment\EquipmentController');
Route::get('equipment-list','Equipment\EquipmentController@equipmentList');
Route::get('equipment-by-vendor/{type}/{id}','Equipment\EquipmentController@vendroEquipment');

Route::resource('expense-equipment','ExpenseHeads\EquipmentExpenseController');
Route::get('equipmenthead-list','ExpenseHeads\EquipmentExpenseController@EquipmentHeadList');