<?php

// admin side routes
Route::prefix('admin')->group(function () {
    // Default page: Dashboard
    Route::redirect('/', '/admin/dashboard');

    // Setup routes
    Route::resources([
        '/dashboard'    => 'Admin\DashboardController',
        '/pages'        => 'Admin\PagesController',
        '/settings'     => 'Admin\SettingsController',
    ]);

    // Abort to prevent showing Public-Side
    Route::fallback(function ($uri = null) {
        return abort(404);
    });
});

// public side catch all
Route::fallback(function ($output = null) {
    return abort(404);
});
