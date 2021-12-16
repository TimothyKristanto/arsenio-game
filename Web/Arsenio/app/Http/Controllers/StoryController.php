<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Story;
use App\Models\StoryLevel;

class StoryController extends Controller
{

    public function index($id, $storyDesc){
        $student = Student::where('user_id', Auth::user()->id)->first();

        $storyLevel = StoryLevel::where('story_id', $id)->get();

        if($storyDesc == 't'){
            return back()->with('storyDesc', $storyLevel[0]->story->story_desc);
        }

        return view('story', [
            'page' => 'STORY MODE',
            'student'=>$student,
            'storyLevel'=>$storyLevel
        ]);
    }

}
