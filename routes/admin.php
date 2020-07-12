<?php

use Illuminate\Support\Facades\Route;

// admin and admin auth related info 

Route::resource('admin','Admin\AdminController');
Route::get('logout','Admin\AdminController@logout');

// setting change password
Route::get('change-password',['as'=>'password.change','uses'=>'AdminController@changePassword']);
Route::post('change-password',['as'=>'password.post','uses'=>'AdminController@PostPassword']);

// role permission 

Route::resource('role','Admin\RoleController'); 
Route::get('role/delete/{id}','Admin\RoleController@destroy');
Route::post('role/update/{id}','Admin\RoleController@update');
Route::post('permission','Admin\RoleController@Permission');
Route::get('role-list','Admin\RoleController@RoleList');
Route::get('all-role','Admin\RoleController@allRole');