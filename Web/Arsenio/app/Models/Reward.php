<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    use HasFactory;

    protected $table = 'senrup_rewards';

    protected $fillable = [
        'name',
        'image'
    ];

    public function storyLevels(){
        return $this->belongsToMany(StoryLevel::class, 'senrup_levels_rewards', 'reward_id', 'level_id');
    }
}
