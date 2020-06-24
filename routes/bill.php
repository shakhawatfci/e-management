<?php

Route::resource('bill','Bill\BillController');
Route::get('bill-list','Bill\BillController@billList');

