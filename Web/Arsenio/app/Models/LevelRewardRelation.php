<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelRewardRelation extends Model
{
    use HasFactory;

    protected $table = 'senrup_levels_rewards';

    protected $fillable = [
        'level_id',
        'reward_id',
        'reward_amount'
    ];
}
