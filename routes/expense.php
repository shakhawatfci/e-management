<?php
// -- Expense Head--
Route::resource('equipment-expense-head','ExpenseHeads\EquipmentExpenseController');
Route::get('equipmenthead-list','ExpenseHeads\EquipmentExpenseController@EquipmentHeadList');

Route::resource('project-expense-head','ExpenseHeads\ProjectExpenseController');
Route::get('projecthead-list','ExpenseHeads\ProjectExpenseController@projectHeadList');

Route::resource('office-expense-head','ExpenseHeads\OfficeExpenseController');
Route::get('officehead-list','ExpenseHeads\OfficeExpenseController@officeHeadList');

// -- Expense --
Route::resource('office-expense','Expense\OfficeExpenseController');
Route::get('office-expense-list','Expense\OfficeExpenseController@officeExpenseList');
Route::get('office-head-data','ExpenseHeads\OfficeExpenseController@officeHeadData');

Route::resource('project-expense','Expense\ProjectExpenseController');
Route::get('project-expense-list','Expense\ProjectExpenseController@projectExpenseList');

Route::resource('equipment-expense','Expense\EquipmentExpenseController');
Route::get('equipment-data','Expense\EquipmentExpenseController@equipmentExpenseData');
Route::get('equipment-expense-list','Expense\EquipmentExpenseController@equipmentExpenseList');