<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseModule extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'module_number',
    ];

    public function contents() {
        return $this->hasMany(CourseModuleContent::class, 'course_module_id')->orderBy('content_number');
    }
}