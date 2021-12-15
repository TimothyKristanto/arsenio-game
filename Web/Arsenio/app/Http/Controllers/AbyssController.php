<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;

class AbyssController extends Controller
{

    public function index(){
        $student = Student::where('user_id', Auth::id())->first();

        return view('abyss', [
            'page'=>'ABYSS',
            'student'=>$student
        ]);
    }
}
