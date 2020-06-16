<?php

use Illuminate\Support\Facades\Route;

// admin and admin auth related info 

Route::resource('admin','Admin\AdminController');
Route::get('logout','Admin\AdminController@logout');

// setting change password
Route::get('change-password',['as'=>'password.change','uses'=>'AdminController@changePassword']);
Route::post('change-password',['as'=>'password.post','uses'=>'AdminController@PostPassword']);