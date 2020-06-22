<?php

Route::resource('project','Project\ProjectController');
Route::post('project-update/{id}','Project\ProjectController@update');
Route::get('project-list','Project\ProjectController@projectList');

// assign equipment to the project 

Route::resource('assign-equipment','Equipment\EquipmentAssignController');
Route::resource('assigned-equipment-list','Equipment\EquipmenAssignController@equipmentList');