<?php

namespace App\Http\Controllers\Admin\API\Settings;

use App\User;
use Illuminate\Http\Request;
use App\Models\CodeEditorSettings;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CodeEditorAPI extends Controller
{
    public function index()
    {
        return response()->json('hello');
    }

    public function show($userId)
    {
        $user = User::find($userId);

        // user not found
        if (is_null($user)) {
            return response()->json([
                'error'     => "User not found",
                'success'   => false,
            ]);
        }

        $settings = $user->editorSettings;

        // create settings if doesn't exist
        if (is_null($settings)) {
            $settings = new CodeEditorSettings();
            $user->editorSettings()->save($settings);
        }

        return response()->json($settings);
    }

    public function update(Request $request, $userId)
    {
        $user = User::find($userId);

        // user not found
        if (is_null($user)) {
            return response()->json([
                'error'     => "User not found",
                'success'   => false,
            ]);
        }

        $settings = $user->editorSettings;
        $theme = $request->input('theme');
        $keymap = $request->input('keymap');

        if ($theme) {
            $settings->theme = $theme;
        }
        if ($keymap) {
            $settings->keymap = $keymap;
        }

        return response()->json([
            'success' => $settings->save()
        ]);
    }
}
