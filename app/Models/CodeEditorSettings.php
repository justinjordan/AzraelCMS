<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CodeEditorSettings extends Model
{
    public $table = 'editor_settings';

    protected $attributes = [
        'theme'     => 'light',
        'keymap'    => 'default',
    ];
}
