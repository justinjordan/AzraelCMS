<?php

namespace App\Http\Controllers\Admin\API\Settings;

use App\Http\Controllers\Controller;
use App\Models\NavigationItem;

class CategoryAPI extends Controller
{
    public function index()
    {
        return $this->show();
    }

    public function show(int $id = 0)
    {
        $cats = collect();

        $cats->push(new NavigationItem('/admin/settings/templates', 'Templates', 'code'));

        return response()->json($cats->toArray());
    }
}
