<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\StoryResource;
use App\Models\Story;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    //
    function show($id){
        $story = Story::where('story_id', $id)->get();

        return [
            'story'=>StoryResource::collection($story)
        ];
    }
    
}
