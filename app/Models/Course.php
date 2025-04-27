<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'title',
        'description',
        'thumbnail',
        'overview',
        'time_to_complete',
        'price',
        'badge_id',
        'category_id',
    ];

    public function category() {
        return $this->belongsTo(CourseCategory::class, 'category_id');
    }

    public function badge() {
        return $this->belongsTo(CourseBadge::class, 'badge_id');
    }

    public function modules() {
        return $this->hasMany(CourseModule::class, 'course_id')->orderBy('module_number');
    }

    public function comments() {
        return $this->hasMany(CourseComment::class, 'course_id')->orderBy('created_at', 'desc');
    }

    public function reviews() {
        return $this->hasMany(CourseReview::class, 'course_id')->orderBy('created_at', 'desc');
    }
}