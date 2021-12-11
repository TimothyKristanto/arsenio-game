<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoryController extends Controller
{

    public function index(){
        return view('story', [
            'page' => 'STORY MODE'
        ]);
    }

}
