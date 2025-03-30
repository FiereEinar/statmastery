<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseModuleContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_module_id',
        'title',
        'content',
        'content_number',
    ];
}
