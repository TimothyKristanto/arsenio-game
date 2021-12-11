<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameLog extends Model
{
    use HasFactory;

    protected $table = 'senrup_logs';

    protected $fillable = [
        'table',
        'student_id',
        'log_desc',
        'log_path',
        'log_ip'
    ];

    public function student(){
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }
}
