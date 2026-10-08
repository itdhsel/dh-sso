<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

/**
     * Get the user's job description from their formatted name.
     */
    public function getJobDescriptionAttribute()
    {
        // Extract the text inside the last set of parentheses in the user's name
        // Example: "Muhammad Haziq (ITD)" will extract "ITD"
        if (preg_match('/\(([^)]+)\)[^()]*$/', $this->name, $matches)) {
            return $matches[1];
        }
        
        return 'UNKNOWN';
    }
}