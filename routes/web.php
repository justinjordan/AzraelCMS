<?php

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

/**
 * Admin-Side Routes
 */
Route::prefix('admin')->group(function () {
    /**
     * Dashboard
     */
    Route::redirect('/', '/dashboard', 301);
    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    /**
     * Pages
     */
    Route::get('/pages', function () {
        return view('pages');
    });

    /**
     * Settings
     */
    Route::get('/settings', function () {
        return view('settings');
    });

    /**
     * Abort to prevent showing Public-Side
     */
    Route::fallback(function ($uri = null) {
        return abort(404);
    });
});

/**
 * Public-Side Catch-All
 */
Route::fallback(function ($output = null) {
    /**
     * TODO: Create public-side pages router
     */
    return $output;
});
