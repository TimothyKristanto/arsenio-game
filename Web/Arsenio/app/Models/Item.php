<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'senrup_items';

    protected $fillable = [
        'name',
        'image',
        'amount',
        'single_price',
        'description'
    ];

    public function students(){
        $this->belongsToMany(Student::class, 'senrup_items_students', 'item_id', 'student_id');
    }
}
