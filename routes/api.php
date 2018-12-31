<?php

use Illuminate\Http\Request;

/**
 * Routes only accessible via admin panel
 */
Route::group([
    'namespace'     => 'Admin\API',
    'prefix'        => 'admin',
    'middleware'    => [
        'auth:api',
        'scopes:admin-access',
    ],
], function () {
    Route::apiResources([
        '/pages'                => 'PagesAPI',
        '/settings/categories'  => 'Settings\CategoryAPI',
        'settings/code-editor'  => 'Settings\CodeEditorAPI',
    ]);
});
