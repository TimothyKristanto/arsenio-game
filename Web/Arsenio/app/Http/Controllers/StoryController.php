<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Story;

class StoryController extends Controller
{

    public function index($id, $storyDesc){
        $student = Student::where('user_id', Auth::user()->id)->first();

        $story = Story::where('story_id', $id)->first();

        if($storyDesc == 't'){
            return back()->with('storyDesc', $story->story_desc);
        }

        return view('story', [
            'page' => 'STORY MODE',
            'student'=>$student,
            'story'=>$story
        ]);
    }

}
