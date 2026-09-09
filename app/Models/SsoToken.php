<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class SsoToken extends Model
{

    protected $fillable = [

        'token',
        'user_id',
        'application_code',
        'expires_at',

    ];


    protected $casts = [

        'expires_at' => 'datetime',

    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }

}