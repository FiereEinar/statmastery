<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $casts = [
        'options' => 'array',
        'correct_answer' => 'array', // for multiple correct answers (like enumeration)
    ];

    protected $fillable = [
        'course_module_content_id',
        'question',
        'quiz_type',
        'options',
        'correct_answer',
    ];
}