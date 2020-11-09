<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', 'Dashboard\DashboardController@index');
    Route::get('change-theme/{theme}', function ($theme) {

        if ($theme == 'dark') {
            session()->forget('theme');
        } else {
            session(['theme' => $theme]);
        }

        return redirect()->back();

    })->name('admin.theme');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
