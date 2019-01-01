<?php

Route::get('/admin/signin', 'Admin\LoginController@index')->name('login');
Route::post('/admin/signin', 'Admin\LoginController@submit');
Route::get('/admin/signout', 'Admin\LoginController@logout');

// admin side routes
Route::group([
    'namespace'     => 'Admin',
    'prefix'        => 'admin',
    'middleware'    => 'auth',
], function () {
    // redirect to dashboard
    Route::redirect('/', '/admin/dashboard');

    // dashboard
    Route::get('/dashboard', 'DashboardController@index');

    // pages
    Route::get('/pages', 'PagesController@index');

    // settings
    Route::get('/settings', 'SettingsController@index');

    // settings/templates
    Route::resource('/settings/templates', 'Settings\TemplatesController');

    // admin-side 404
    Route::fallback(function ($uri = null) {
        return abort(404);
    });
});

// public side catch all
Route::fallback(function ($output = null) {
    return abort(404);
});
