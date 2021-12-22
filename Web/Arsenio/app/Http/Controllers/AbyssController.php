<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\User;

class AbyssController extends Controller
{

    public function index(){
        $student = Student::where('user_id', Auth::user()->id)->first();

        return view('abyss', [
            'page'=>'ABYSS',
            'student'=>$student,
            'user'=>$student->user,
            'studentPoint'=>Student::all()->sortByDesc('abyss_point')
        ]);
    }
}
