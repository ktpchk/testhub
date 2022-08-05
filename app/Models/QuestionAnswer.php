<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_question_id',
        'text',
        'correct',
    ];

    public function testQuestion()
    {
        return $this->belongsTo(TestQuestion::class, 'test_question_id');
    }
}
