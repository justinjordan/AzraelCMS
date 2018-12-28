<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;

class TemplatesController extends Controller
{
    public function index()
    {
        return view('settings.templates');
    }

    public function show()
    {
        // redirect to index
        return redirect('/admin/settings/templates');
    }
}
