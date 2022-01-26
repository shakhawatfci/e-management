<?php

Route::get('monthly-report',['as'=>'report.monthly','uses' => 'Report\ReportController@montlyReportPage']);

Route::get('project-wise-report',['as'=>'report.projectwise','uses' => 'Report\ReportController@projectwiseReportPage']);

Route::get('equipment-wise-report',['as'=>'report.equipmentwise','uses' => 'Report\ReportController@equipmentWiseReportPage']);

Route::get('monthly-report-result','Report\ReportController@monthlyReportResult');
Route::get('projectly-report-result','Report\ReportController@projectlyReportResult');
Route::get('equpmently-report-result','Report\ReportController@equipmentlyReportResult');
Route::get('monthly-report-list-print-pdf','Report\ReportController@monthlyReportPrint');//from MonthlyReport
Route::get('project-wise-report-list-print-pdf','Report\ReportController@projectWiseReportPrint');//from ProjectWiseReport

Route::get('equipment-wise-report-list-print-pdf','Report\ReportController@equipmentWiseReportPrint');//from EquipmentWiseReport

