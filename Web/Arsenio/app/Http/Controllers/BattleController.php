<?php

namespace App\Http\Controllers;

use App\Models\CharacterExp;
use App\Models\LevelRewardRelation;
use App\Models\Question;
use App\Models\StoryLevel;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

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
    public function show($id, $mode, $answerCorrect, $questionId, $userHealth, $firstAnim)
    {
        //
        $student = Student::where('student_id', Auth::id())->first();

        if($mode == 'story'){
            $rewards = LevelRewardRelation::where('level_id', $id)->get();

            $storyLevel = StoryLevel::where('level_id', $id)->first();

            $question = collect(Question::where('level_id', $id)->get());

            $array = collect(explode('-', $questionId));

            if($userHealth == 'r'){
                $userHealth = Student::where('student_id', Auth::user()->id)->first()->characterExp->health;
            }

            if($answerCorrect == 'f'){
                $array->forget($array->count() - 1);
                $questionId = $array->join('-');

                $userHealth -= $storyLevel->enemy->damage;
            }

            if($array->count() > 0){
                foreach($array as $id){
                    if($id != 'n'){
                        $question->forget($id);
                    }
                }
            }

            if($userHealth <= 0){
                $battleStatus = 'lose';
                $userHealth = 0;

                return view('battle', [
                    'storyLevel'=>$storyLevel,
                    'userHealth'=>$userHealth,
                    'enemyAttack'=>$storyLevel->enemy->damage,
                    'enemyHealth'=>$question->count(),
                    'mode'=>$mode,
                    'questionId'=>$questionId,
                    'firstAnim'=>$firstAnim,
                    'battleStatus'=>$battleStatus,
                    'correctAnswer'=>'',
                    'battleQuestionId'=>'',
                    'rewards'=>$rewards
                ]);
            }else if($question->count() == 0){
                $battleStatus = 'win';

                // $storyLevelProgress = $id;

                // if($id % 5 != 0 && $id != 25){
                //     $storyLevelProgress = $id + 1;
                // }else if($id % 5 == 0 && $id != 25){
                //     $storyLevelProgress = $id + 6;
                // }

                // $student->update([
                //     'golds'=>$student->golds + $rewards[0]->reward_amount,
                //     'total_exp'=>$student->total_exp + $rewards[1]->reward_amount,
                //     'story_level_progress'=>$storyLevelProgress
                // ]);

                // $expId = CharacterExp::where('level_up_exp', '<=', $student->total_exp)
                //             ->orderBy('level_up_exp', 'desc')
                //             ->first();

                // $student->update([
                //     'exp_id'=>$expId->exp_id
                // ]);

                return view('battle', [
                    'storyLevel'=>$storyLevel,
                    'userHealth'=>$userHealth,
                    'enemyAttack'=>$storyLevel->enemy->damage,
                    'enemyHealth'=>$question->count(),
                    'mode'=>$mode,
                    'questionId'=>$questionId,
                    'firstAnim'=>$firstAnim,
                    'battleStatus'=>$battleStatus,
                    'correctAnswer'=>'',
                    'battleQuestionId'=>'',
                    'rewards'=>$rewards
                ]);
            }else{
                $battleStatus = '';
            }


            $randomizedQuestion = $question->random();

            $battleQuestionId = $question->search($randomizedQuestion);

            $battleAnswer = collect([]);

            $battleAnswer->push($randomizedQuestion->correct_answer);
            $battleAnswer->push($randomizedQuestion->answer_b);
            $battleAnswer->push($randomizedQuestion->answer_c);
            $battleAnswer->push($randomizedQuestion->answer_d);

            $randomizedAnswer = collect([]);
            while($randomizedAnswer->count() < 4 || $randomizedAnswer == null){
                $answer = $battleAnswer->random();

                if($randomizedAnswer->contains($answer) == false){
                    $randomizedAnswer->push($answer);
                }
            }

            return view('battle', [
                'storyLevel'=>$storyLevel,
                'userHealth'=>$userHealth,
                'enemyAttack'=>$storyLevel->enemy->damage,
                'enemyHealth'=>$question->count(),
                'question'=>$randomizedQuestion->question,
                'answers'=>$randomizedAnswer,
                'mode'=>$mode,
                'correctAnswer'=>$randomizedQuestion->correct_answer,
                'battleQuestionId'=>$battleQuestionId,
                'questionId'=>$questionId,
                'firstAnim'=>$firstAnim,
                'battleStatus'=>$battleStatus,
                'rewards'=>$rewards
            ]);
        }else{

        }
        
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
