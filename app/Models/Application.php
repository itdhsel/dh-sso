<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'name',
        'description',
        'url',
        'icon',
        'active',
        'required_group',
    ];


    protected $casts = [
        'active' => 'boolean',
    ];
}