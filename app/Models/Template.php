<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    public $table = 'templates';

    protected $attributes = [
        'name'      => 'New Template',
        'type'      => 'layout',
        'active'    => true,
        'content'   => '',
    ];
}
