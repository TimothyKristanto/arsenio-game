<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enemy extends Model
{
    use HasFactory;

    protected $table = 'senrup_enemies';

    protected $fillable = [
        'name',
        'image',
        'damage'
    ];

    public function storyLevels(){
        return $this->hasMany(StoryLevel::class, 'enemy_id', 'enemy_id');
    }
}
