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
    ];

    public function badge() {
        return $this->belongsTo(CourseBadge::class, 'badge_id');
    }

    public function modules() {
        return $this->hasMany(CourseModule::class, 'course_id')->orderBy('module_number');
    }
}