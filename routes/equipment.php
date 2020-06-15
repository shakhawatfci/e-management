<?php

use Illuminate\Support\Facades\Route;

// equipment and equipment auth related info 

Route::resource('equipment','Equipment\EquipmentController');
Route::get('equipment-list','Equipment\EquipmentController@equipmentList');