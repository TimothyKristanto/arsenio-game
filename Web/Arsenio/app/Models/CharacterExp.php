<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CharacterExp extends Model
{
    use HasFactory;

    protected $table = 'senrup_character_exps';

    protected $fillable = [
        'health',
        'level_up_exp',
        'damage'
    ];

    public function students(){
        return $this->hasMany(Student::class, 'exp_id', 'exp_id');
    }
}
