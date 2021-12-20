<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'senrup_students';

    protected $primaryKey = 'student_id';

    protected $fillable = [
        'golds',
        'total_exp',
        'abyss_point',
        'story_level_progress',
        'exp_id',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function items(){
        return $this->belongsToMany(Item::class, 'senrup_items_students', 'student_id', 'item_id');
    }

    public function characterExp(){
        return $this->belongsTo(CharacterExp::class, 'exp_id', 'exp_id');
    }

    public function gameLogs(){
        return $this->hasMany(GameLog::class, 'student_id', 'student_id');
    }

    public function storyLevel(){
        return $this->belongsTo(StoryLevel::class, 'story_level_progress', 'level_id');
    }
}
