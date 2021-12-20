<?php

namespace App\Http\Controllers;

use App\Models\CharacterExp;
use App\Models\Enemy;
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
    public function show($id, $mode, $answerCorrect, $questionId, $userHealth, $firstAnim, $abyssScore)
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
                foreach($array as $answerId){
                    if($answerId != 'n'){
                        $question->forget($answerId);
                    }
                }
            }

            $battleStatus = '';

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
                    'rewards'=>$rewards,
                    'levelId'=>$id,
                    'abyssScore'=>'n'
                ]);
            }else if($question->count() == 0){
                $battleStatus = 'win';

                $storyLevelProgress = $student->story_level_progress;
                $totalExp = $student->total_exp;
                $golds = $student->golds;

                if($storyLevel->level_id < $student->story_level_progress){
                    $rewards[0]->reward_amount = floor($rewards[0]->reward_amount / 2);
                    $rewards[1]->reward_amount = floor($rewards[1]->reward_amount / 2);

                    $totalExp = $student->total_exp + ($rewards[1]->reward_amount);
                    $golds = $student->golds + ($rewards[0]->reward_amount);
                }else{
                    $totalExp = $student->total_exp + $rewards[1]->reward_amount;
                    $golds = $student->golds + $rewards[0]->reward_amount;

                    if($id % 5 != 0 && $id < 25){
                        $storyLevelProgress = $id + 1;
                    }else if($id % 5 == 0 && $id < 25){
                        $storyLevelProgress = $id + 6;
                    }
                }

                $exp = CharacterExp::where('level_up_exp', '<=', $totalExp)
                            ->orderBy('level_up_exp', 'desc')
                            ->first();

                $expId = $exp->exp_id;

                if($exp->level_up_exp <= $totalExp){
                    $expId = $exp->exp_id + 1;
                }

                $student->update([
                    'golds'=>$golds,
                    'total_exp'=>$totalExp,
                    'story_level_progress'=>$storyLevelProgress,
                    'exp_id'=>$expId
                ]);

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
                    'rewards'=>$rewards,
                    'levelId'=>$id,
                    'abyssScore'=>'n'
                ]);
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
                'rewards'=>$rewards,
                'levelId'=>$id,
                'abyssScore'=>'n'
            ]);
        }else if($mode == 'abyss'){
            $enemy = Enemy::where('name', 'Iblis Kekal')->first();

            $questions = collect(Question::all());

            if($answerCorrect == 'f'){
                $userHealth -= $enemy->damage;
            }else if($answerCorrect == 't'){
                $abyssScore += 250;
            }

            $battleStatusAbyss = '';

            if($userHealth <= 0){
                $battleStatusAbyss = 'lose';

                $userHealth = 0;

                $totalExp = $student->total_exp + (floor($abyssScore * 0.003));
                $golds = $student->golds + (floor($abyssScore * 0.1));

                $exp = CharacterExp::where('level_up_exp', '<=', $totalExp)
                            ->orderBy('level_up_exp', 'desc')
                            ->first();

                $expId = $student->exp_id;

                if($exp != null){
                    $expId = $exp->exp_id;

                    if($exp->level_up_exp <= $totalExp){
                        $expId = $exp->exp_id + 1;
                    }
                }

                $studentAbyssScore = $student->abyss_point;

                if($abyssScore > $studentAbyssScore){
                    $studentAbyssScore = $abyssScore;
                }

                $student->update([
                    'golds'=>$golds,
                    'total_exp'=>$totalExp,
                    'exp_id'=>$expId,
                    'abyss_point'=>$studentAbyssScore
                ]);

                return view('battle', [
                    'enemy'=>$enemy,
                    'abyssBg'=>'/images/AbyssBG.png',
                    'levelId'=>'n',
                    'userHealth'=>$userHealth,
                    'enemyAttack'=>$enemy->damage,
                    'enemyHealth'=>'',
                    'question'=>'',
                    'answers'=>'',
                    'mode'=>$mode,
                    'correctAnswer'=>'',
                    'battleQuestionId'=>'',
                    'questionId'=>$questionId,
                    'firstAnim'=>$firstAnim,
                    'battleStatus'=>$battleStatusAbyss,
                    'rewards'=>[floor($abyssScore * 0.1), floor($abyssScore * 0.003)],
                    'abyssScore'=>$abyssScore
                ]);
            }

            $randomizedQuestion = $questions->random();

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
                'enemy'=>$enemy,
                'abyssBg'=>'/images/AbyssBG.png',
                'levelId'=>'n',
                'userHealth'=>$userHealth,
                'enemyAttack'=>$enemy->damage,
                'enemyHealth'=>'',
                'question'=>$randomizedQuestion->question,
                'answers'=>$randomizedAnswer,
                'mode'=>$mode,
                'correctAnswer'=>$randomizedQuestion->correct_answer,
                'battleQuestionId'=>'',
                'questionId'=>$questionId,
                'firstAnim'=>$firstAnim,
                'battleStatus'=>$battleStatusAbyss,
                'rewards'=>[floor($abyssScore * 0.1), floor($abyssScore * 0.003)],
                'abyssScore'=>$abyssScore
            ]);
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
