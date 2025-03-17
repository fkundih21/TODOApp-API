<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'time',
        'is_completed',
        'has_reminder',
        'user_id'
    ];

    protected $casts = [
        'time' => 'datetime',
        'is_completed' => 'boolean',
        'has_reminder' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
