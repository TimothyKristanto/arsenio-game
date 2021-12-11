<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'senrup_questions';

    protected $fillable = [
        'question',
        'correct_answer',
        'answer_b',
        'answer_c',
        'answer_d',
        'level_id'
    ];

    public function storyLevel(){
        return $this->belongsTo(StoryLevel::class, 'level_id', 'level_id');
    }
}
