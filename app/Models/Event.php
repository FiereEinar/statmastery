<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'start',
        'end',
        'is_all_day'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}