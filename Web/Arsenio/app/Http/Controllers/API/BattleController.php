<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BattleStudentDataResource;
use App\Http\Resources\EnemyResource;
use App\Http\Resources\QuestionResource;
use App\Models\Enemy;
use App\Models\Question;
use App\Models\StoryLevel;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BattleController extends Controller
{
    //
    public function index($levelId){
        $student = Student::where('user_id', Auth::user()->id)->get();
        $storyLevel = StoryLevel::where('level_id', $levelId)->get();
        
        return [
            'battleStudentData'=>BattleStudentDataResource::collection($student),
            'enemy'=>EnemyResource::collection($storyLevel)
        ];
    }

    public function show($levelId, $questionIndex){
        $questions = Question::where('level_id', $levelId)->get();

        return [
            'question'=>new QuestionResource($questions[$questionIndex]),
            'questionAmount'=>count($questions)
        ];
    }
}
