<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'user_id',
        'answers',
        'score',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function moduleContent() {
        return $this->belongsTo(CourseModuleContent::class, 'quiz_id');
    }
}