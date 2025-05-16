<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoogleToken extends Model
{
    protected $fillable = [
        'user_identifier',
        'access_token',
        'refresh_token',
        'expires_in',
    ];
}