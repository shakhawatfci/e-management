<?php

Route::resource('project','Project\ProjectController');
Route::post('project-update/{id}','Project\ProjectController@update');
Route::get('project-list','Project\ProjectController@projectList');

// assign equipment to the project 

// Route::resource('assign-equipment','Equipment\EquipmentAssignController');
// Route::get('assigned-equipment-list','Equipment\EquipmentAssignController@assignedEquipmentList');
// Route::put('release-equipment/{id}','Equipment\EquipmentAssignController@releaseEquipment');

// project claim 


// project payment 


// vendor payment 