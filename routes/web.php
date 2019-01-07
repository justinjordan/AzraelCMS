<?php

Route::get('/admin/signin', 'Admin\LoginController@index')->name('login');
Route::post('/admin/signin', 'Admin\LoginController@submit');
Route::get('/admin/signout', 'Admin\LoginController@logout');

// admin side routes
Route::group([
    'prefix'        => 'admin',
    'middleware'    => 'auth',
], function () {
    Route::any('/{any?}', 'AdminController@index');
    Route::fallback('AdminController@index');
});

// public side catch all
Route::fallback(function ($output = null) {
    return abort(404);
});
