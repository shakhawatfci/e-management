<?php

use Illuminate\Support\Facades\Route;

// admin and admin auth related info 

Route::resource('admin','Admin\AdminController');
Route::get('logout','Admin\AdminController@logout');