<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\AbyssResource;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbyssController extends Controller
{
    //
    function show(){
        $student = Student::where('user_id', Auth::user()->id)->get();
        $student_leaderboard = Student::all()->sortByDesc('abyss_point');

        return [
            'student'=>AbyssResource::collection($student),
            'student_leaderboard'=>AbyssResource::collection($student_leaderboard)
        ];
    }
}
