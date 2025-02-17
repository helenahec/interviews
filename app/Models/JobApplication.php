<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'company', 'response', 'step', 'interview_date', 'next_date', 'status', 'position'
    ];

    protected $casts = [
        'interview_date' => 'date',
        'next_date' => 'date',
    ];
}
