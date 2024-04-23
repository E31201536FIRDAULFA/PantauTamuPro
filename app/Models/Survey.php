<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;
    protected $table = 'survey_questions';
    protected $fillable = [
        'question',
        'baik',
        'sangat_baik',
        'buruk',
        'sangat_buruk',
       
    ];
}
