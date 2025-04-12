<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressTracking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'module_id',
        'content_id',
    ];
}