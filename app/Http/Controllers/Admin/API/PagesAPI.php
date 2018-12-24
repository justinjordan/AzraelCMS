<?php

namespace App\Http\Controllers\Admin\API;

use App\Http\Controllers\Controller;

class PagesAPI extends Controller
{
    public function index()
    {
        return response()->json([
            'message'   => 'controller works',
        ]);
    }
}
