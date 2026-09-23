<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'name',
        'code',           // Added
        'description',
        'server_ip',      // Added
        'url',
        'icon',
        'active',
        'required_group',
        'sso_type',       // Added
    ];

    protected $casts = [
        'active' => 'boolean',
    ];
}