<?php

namespace App\Http\Controllers\Admin\Settings\Templates;

use App\Http\Controllers\Controller;

class EditController extends Controller
{
    public function index(int $id = 0)
    {
        return view('settings.templates.edit');
    }
}
