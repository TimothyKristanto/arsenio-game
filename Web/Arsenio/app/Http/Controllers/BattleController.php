<?php

namespace App\Http\Controllers;

use App\Models\StoryLevel;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class BattleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StoryLevel  $storyLevel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $storyLevel = StoryLevel::where('level_id', $id)->first();

        $student = Student::where('student_id', Auth::user()->id)->first();

        return view('battle', [
            'bgBattle'=>$storyLevel->story->image,
            'userHealth'=>$student->characterExp->health,
            'enemyAttack'=>$storyLevel->enemy->damage
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StoryLevel  $storyLevel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StoryLevel  $storyLevel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StoryLevel  $storyLevel
     * @return \Illuminate\Http\Response
     */
    public function destroy(StoryLevel $storyLevel)
    {
        //
    }
}
