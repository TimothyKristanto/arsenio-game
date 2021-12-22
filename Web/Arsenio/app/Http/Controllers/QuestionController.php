<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\StoryLevel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = User::where('id', Auth::user()->id)->first();

        $questions = Question::all();

        return view('question', [
            'page'=>'ADMIN: See questions',
            'user'=>$user,
            'questions'=>$questions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = User::where('id', auth()->user()->id)->first();

        $storyLevel = StoryLevel::all();

        return view('createQuestion', [
            'page'=>'ADMIN: Create question',
            'user'=>$user,
            'storyLevels'=>$storyLevel
        ]);
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
        Question::create([
            'question'=>$request->question,
            'correct_answer'=>$request->correct_answer,
            'answer_b'=>$request->answer_b,
            'answer_c'=>$request->answer_c,
            'answer_d'=>$request->answer_d,
            'level_id'=>$request->level_id
        ]);

        return redirect('/admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', auth()->user()->id)->first();

        $question = Question::where('question_id', $id)->first();

        return view('showQuestion', [
            'page'=>'ADMIN: Show question details',
            'user'=>$user,
            'question'=>$question
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::where('id', auth()->user()->id)->first();

        $question = Question::where('question_id', $id)->first();

        $storyLevels = StoryLevel::all();

        return view('editQuestion', [
            'page'=>'ADMIN: Edit question',
            'user'=>$user,
            'question'=>$question,
            'storyLevels'=>$storyLevels
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Question::where('question_id', $id)->update([
            'question'=>$request->question,
            'correct_answer'=>$request->correct_answer,
            'answer_b'=>$request->answer_b,
            'answer_c'=>$request->answer_c,
            'answer_d'=>$request->answer_d,
            'level_id'=>$request->level_id
        ]);

        return redirect(route('question.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Question::where('question_id', $id)->delete();

        return redirect(route('question.index'));
    }
}
