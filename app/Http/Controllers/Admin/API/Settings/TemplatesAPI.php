<?php

namespace App\Http\Controllers\Admin\API\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Template;
use Exception;

class TemplatesAPI extends Controller
{
    public function index()
    {
        return response()->json(Template::all());
    }

    public function show($id)
    {
        $template = Template::find($id);

        if (is_null($template)) {
            return abort(404, "Template not found");
        }

        return response()->json($template);
    }

    public function update(Request $request, $id)
    {
        $template = Template::find($id);

        if (is_null($template)) {
            return abort(404, "Template not found");
        }

        $template->content = (string)$request->input('content');

        if (!$template->save()) {
            return abort(500, "Unable to save template");
        }

        return response()->json([
            'success' => true,
        ]);
    }
}
