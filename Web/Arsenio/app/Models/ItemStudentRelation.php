<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemStudentRelation extends Model
{
    use HasFactory;

    protected $table = 'senrup_items_students';

    protected $fillable = [
        'item_id',
        'student_id',
        'item_owned'
    ];
}
