<?php

Route::resource('project','Project\ProjectController');
Route::post('project-update/{id}','Project\ProjectController@update');
Route::get('project-list','Project\ProjectController@projectList');