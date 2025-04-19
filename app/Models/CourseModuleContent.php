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
        'content_type_id',
        'content_number',
    ];

    public function content_type() {
        return $this->belongsTo(CourseModuleContentType::class, 'content_type_id');
    }

    public function contentQuizzes() {
        return $this->hasMany(Quiz::class,'course_module_content_id');
    }
}