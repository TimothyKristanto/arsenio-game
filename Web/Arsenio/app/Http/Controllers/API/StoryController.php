<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\StoryResource;
use App\Http\Resources\StoryStudentDataResource;
use App\Models\Story;
use App\Models\StoryLevel;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class StoryController extends Controller
{
    //
    public function show($id){
        $student = Student::where('user_id', Auth::user()->id)->get();
        $story = Story::where('story_id', $id)->get();
    

        return [
            'storyData'=>StoryResource::collection($story),
            'storyStudentData'=>StoryStudentDataResource::collection($student)
        ];
    }
    
}
