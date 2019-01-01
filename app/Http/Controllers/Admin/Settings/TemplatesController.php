<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;

class TemplatesController extends Controller
{
    public function index()
    {
        return view('settings.templates');
    }

    public function show($id)
    {
        return redirect('/admin/settings/templates/'.$id.'/edit');
    }

    public function edit($id)
    {
        return view('settings.templates.edit', [
            'templateId'    => $id,
        ]);
    }
}
