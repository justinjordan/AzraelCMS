<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings');
    }

    public function show(string $slug)
    {
        $view = 'settings.'.$slug;

        if (!view()->exists($view)) {
            return abort(404);
        }

        return view($view);
    }
}
