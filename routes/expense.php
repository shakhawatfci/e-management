<?php
// -- Expense Head--
Route::resource('equipment-expense-head','ExpenseHeads\EquipmentExpenseController');
Route::get('equipmenthead-list','ExpenseHeads\EquipmentExpenseController@EquipmentHeadList');
Route::get('equipment-category-list-print-pdf','ExpenseHeads\EquipmentExpenseController@EquipmentHeadListPrint');

Route::resource('project-expense-head','ExpenseHeads\ProjectExpenseController');
Route::get('projecthead-list','ExpenseHeads\ProjectExpenseController@projectHeadList');
Route::get('project-expense-category-print-pdf','ExpenseHeads\ProjectExpenseController@projectHeadListPrint');

Route::resource('office-expense-head','ExpenseHeads\OfficeExpenseController');
Route::get('officehead-list','ExpenseHeads\OfficeExpenseController@officeHeadList');
Route::get('office-expense-category-print-pdf','ExpenseHeads\OfficeExpenseController@officeHeadListPrint');

// -- Expense --
Route::resource('office-expense','Expense\OfficeExpenseController');
Route::get('office-expense-list','Expense\OfficeExpenseController@officeExpenseList');
Route::get('office-head-data','ExpenseHeads\OfficeExpenseController@officeHeadData');
Route::get('office-expense-print-pdf','Expense\OfficeExpenseController@officeExpensePrint');

Route::resource('project-expense','Expense\ProjectExpenseController');
Route::get('project-expense-list','Expense\ProjectExpenseController@projectExpenseList');
Route::get('project-expense-print-pdf','Expense\ProjectExpenseController@projectExpenseListPrint');

Route::resource('equipment-expense','Expense\EquipmentExpenseController');
Route::get('equipment-data','Expense\EquipmentExpenseController@equipmentExpenseData');
Route::get('equipment-expense-list','Expense\EquipmentExpenseController@equipmentExpenseList');
Route::get('equipment-expense-print-pdf','Expense\EquipmentExpenseController@equipmentExpensePrint');