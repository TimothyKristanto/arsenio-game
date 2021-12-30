<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\HomeResource;
use App\Http\Resources\NavbarResource;
use App\Http\Resources\StoryResource;
use App\Models\Story;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class StoryController extends Controller
{
    //
    function show($id){
        $student = Student::where('student_id', Auth::user()->id)->get();
        $story = Story::where('story_id', $id)->get();

        return [
            'storyData'=>StoryResource::collection($story),
            'navbar'=>NavbarResource::collection($student)
        ];
    }
    
}
