<?php

use Illuminate\Support\Facades\Route;

// equipment and equipment auth related info

// equipment type

Route::resource('equipment-type', 'Equipment\EquipmentTypeController');
Route::get('equipment-category-list', 'Equipment\EquipmentTypeController@equipmentTypeList');
Route::get('equipment-type-list-print-pdf', 'Equipment\EquipmentTypeController@equipmentTypeListPrint');

Route::resource('equipment', 'Equipment\EquipmentController');
Route::get('equipment-list', 'Equipment\EquipmentController@equipmentList');
Route::get('equipment-list-print-pdf', 'Equipment\EquipmentController@equipmentListPrint');

Route::get('equipment-by-vendor/{type}/{id}', 'Equipment\EquipmentController@vendroEquipment');
// Qoutation
Route::resource('quotation', 'QuotationController');
Route::get('qoutation-list', 'QuotationController@quotationList');
Route::get('qoutation/print/{id}', 'QuotationController@printQoutation');

Route::resource('assign-equipment', 'Equipment\EquipmentAssignController');
Route::resource('assigned-equipment-list', 'Equipment\EquipmenAssignController@equipmentList');
