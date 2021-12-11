<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;

    protected $table = 'senrup_stories';

    protected $fillable = [
        'title',
        'story_desc',
        'image'
    ];

    public function students(){
        return $this->hasMany(Student::class, 'story_on_progress', 'story_id');
    }

    public function storyLevels(){
        return $this->hasMany(StoryLevel::class, 'story_id', 'story_id');
    }
}
