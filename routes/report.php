<?php

Route::get('monthly-report',['as'=>'report.montly','uses' => 'Report\ReportController@montlyReportPage']);
Route::get('project-wise-report',['as'=>'report.projectwise','uses' => 'Report\ReportController@projectwiseReportPage']);
Route::get('equipment-wise-report',['as'=>'report.montly','uses' => 'Report\ReportController@equipmentWiseReportPage']);

Route::get('montly-report-result','Report\ReportController@monthlyReportResult');
Route::get('projectly-report-result','Report\ReportController@projectlyReportResult');
Route::get('equpmently-report-result','Report\ReportController@equipmentlyReportResult');