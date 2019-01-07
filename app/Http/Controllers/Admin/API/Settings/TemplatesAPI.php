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
            return abort(400, "Template not found");
        }

        return response()->json($template);
    }

    public function store(Request $request)
    {
        $template = new Template();

        $props = $request->only(['name', 'type']);

        // assign props
        foreach ($props as $prop => $value) {
            if (empty($value)) {
                continue;
            }

            $template->{$prop} = $value;
        }

        // store in DB
        if (!$template->save()) {
            return abort(500, "Problem creating template");
        }

        return response()->json([
            'success'   => true
        ]);
    }

    public function update(Request $request, $id)
    {
        $template = Template::find($id);

        if (is_null($template)) {
            return abort(400, "Template not found");
        }

        $fields = $request->input();

        if (!empty($fields['name'])) {
            $template->name = $fields['name'];
        }
        if (!empty($fields['type'])) {
            $template->type = $fields['type'];
        }
        if (isset($fields['active'])) {
            $template->active = $fields['active'];
        }
        if (isset($fields['content'])) {
            $template->content = $fields['content'];
        }

        if (!$template->save()) {
            return abort(500, "Problem saving template");
        }

        return response()->json([
            'success'   => true
        ]);
    }

    public function destroy($id)
    {
        if (!Template::destroy($id)) {
            return abort(500, "Problem deleting template");
        }

        // send updated set
        return response()->json([
            'success'   => true,
        ]);
    }
}
