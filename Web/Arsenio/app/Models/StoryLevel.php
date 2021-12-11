<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoryLevel extends Model
{
    use HasFactory;

    protected $table = 'senrup_story_levels';

    protected $fillable = [
        'story_id',
        'open_status',
        'title',
        'level_finished',
        'enemy_id'
    ];

    public function story(){
        return $this->belongsTo(Story::class, 'story_id', 'story_id');
    }

    public function questions(){
        return $this->hasMany(Question::class, 'level_id', 'level_id');
    }

    public function enemy(){
        return $this->belongsTo(Enemy::class, 'enemy_id', 'enemy_id');
    }

    public function rewards(){
        return $this->belongsToMany(Reward::class, 'senrup_levels_rewards', 'level_id', 'reward_id');
    }
}
