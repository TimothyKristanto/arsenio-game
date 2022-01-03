<?php

namespace App\Http\Controllers;

use App\Helpers\UserSystemInfoHelper;
use App\Models\CharacterExp;
use App\Models\Enemy;
use App\Models\GameLog;
use App\Models\ItemStudentRelation;
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
    public function show($id, $mode, $answerCorrect, $questionId, $userHealth, $firstAnim, $abyssScore, $useItem, $countdown, $lastQuestionId)
    {
        //
        $student = Student::where('user_id', Auth::id())->first();

        $studentItem = ItemStudentRelation::where('student_id', $student->student_id)->get();

        GameLog::create([
            'table'=>'senrup_story_level',
            'student_id'=>$student->student_id,
            'log_desc'=>'Student ' . $student->user->name . ' memasuki battle ' . $mode,
            'log_path'=>'/battle/' . $id . '/' . $mode . '/' . $answerCorrect . '/' . $questionId . '/' . $userHealth . '/' . $firstAnim . '/' . $abyssScore . '/' . $useItem . '/' . $countdown . '/' . $lastQuestionId,
            'log_ip'=>UserSystemInfoHelper::get_ip(),
        ]);

        if($useItem != 'n'){
            if($studentItem[$useItem - 1]->item_owned > 0){
                if($useItem == '1'){
                    if($userHealth < $student->characterExp->health){
                        $userHealth += 10;
                    }
        
                    if($userHealth > $student->characterExp->health){
                        $userHealth = $student->characterExp->health;
                    }
                }else if($useItem == '2'){
                    $userHealth = $student->characterExp->health;
                }else if($useItem == '3'){
                    $countdown += 10;
    
                    if($countdown > 25){
                        $countdown = 25;
                    }
                }

                GameLog::create([
                    'table'=>'senrup_items_students',
                    'student_id'=>$student->student_id,
                    'log_desc'=>'Jumlah item' . $studentItem[$useItem - 1]->name . ' student ' . $student->user->name . ': ' . $studentItem[$useItem - 1]->item_owned,
                    'log_path'=>'/battle/' . $id . '/' . $mode . '/' . $answerCorrect . '/' . $questionId . '/' . $userHealth . '/' . $firstAnim . '/' . $abyssScore . '/' . $useItem . '/' . $countdown . '/' . $lastQuestionId,
                    'log_ip'=>UserSystemInfoHelper::get_ip(),
                ]);
    
                $itemOwned = $studentItem[$useItem - 1]->item_owned - 1;
    
                ItemStudentRelation::where('student_id', $student->student_id)
                ->where('item_id', $useItem)->update([
                    'item_owned'=>$itemOwned
                ]);
    
                $studentItem = ItemStudentRelation::where('student_id', $student->student_id)->get();

                GameLog::create([
                    'table'=>'senrup_items_students',
                    'student_id'=>$student->student_id,
                    'log_desc'=>'Jumlah item' . $studentItem[$useItem - 1]->name . ' student ' . $student->user->name . ': ' . $studentItem[$useItem - 1]->item_owned,
                    'log_path'=>'/battle/' . $id . '/' . $mode . '/' . $answerCorrect . '/' . $questionId . '/' . $userHealth . '/' . $firstAnim . '/' . $abyssScore . '/' . $useItem . '/' . $countdown . '/' . $lastQuestionId,
                    'log_ip'=>UserSystemInfoHelper::get_ip(),
                ]);
            }
        }

        if($mode == 'story'){
            $rewards = LevelRewardRelation::where('level_id', $id)->get();

            $storyLevel = StoryLevel::where('level_id', $id)->first();

            $question = collect(Question::where('level_id', $id)->get());

            $array = collect(explode('-', $questionId));

            if($answerCorrect == 'f' || $answerCorrect == 'n'){
                if($array[$array->count() - 1] != 'n'){
                    $array->forget($array->count() - 1);
                }
                $questionId = $array->join('-');

                if($answerCorrect == 'f'){
                    $userHealth -= $storyLevel->enemy->damage;
                }
            }

            if($array->count() > 0){
                foreach($array as $answerId){
                    if($answerId != 'n'){
                        $question->forget($answerId);
                    }
                }
            }

            if($userHealth == 'r'){
                $userHealth = Student::where('student_id', Auth::user()->id)->first()->characterExp->health;
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
                    'abyssScore'=>'n',
                    'studentItem'=>$studentItem,
                    'countdown'=>$countdown
                ]);
            }else if($question->count() == 0){
                $battleStatus = 'win';

                $storyLevelProgress = $student->story_level_progress;
                $totalExp = $student->total_exp;
                $golds = $student->golds;

                if($storyLevel->level_id < $student->story_level_progress){
                    $rewards[0]->reward_amount = floor($rewards[0]->reward_amount / 2);
                    $rewards[1]->reward_amount = floor($rewards[1]->reward_amount / 2);

                    $totalExp = $totalExp + ($rewards[1]->reward_amount);
                    $golds = $golds + ($rewards[0]->reward_amount);
                }else{
                    $totalExp = $totalExp + $rewards[1]->reward_amount;
                    $golds = $golds + $rewards[0]->reward_amount;

                    if($id % 5 != 0 && $id < 25){
                        $storyLevelProgress = $id + 1;
                    }else if($id % 5 == 0 && $id < 25){
                        $storyLevelProgress = $id + 6;
                    }
                }

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

                GameLog::create([
                    'table'=>'senrup_students',
                    'student_id'=>$student->student_id,
                    'log_desc'=>'Status student ' . $student->user->name . '. Jumlah uang: ' . $student->golds . '. Jumlah Exp: ' . $student->total_exp . '. Progress story: ' . $student->story_level_progress . '. Level: ' . $student->exp_id,
                    'log_path'=>'/battle/' . $id . '/' . $mode . '/' . $answerCorrect . '/' . $questionId . '/' . $userHealth . '/' . $firstAnim . '/' . $abyssScore . '/' . $useItem . '/' . $countdown . '/' . $lastQuestionId,
                    'log_ip'=>UserSystemInfoHelper::get_ip(),
                ]);

                $student->update([
                    'golds'=>$golds,
                    'total_exp'=>$totalExp,
                    'story_level_progress'=>$storyLevelProgress,
                    'exp_id'=>$expId
                ]);

                GameLog::create([
                    'table'=>'senrup_students',
                    'student_id'=>$student->student_id,
                    'log_desc'=>'Status student ' . $student->user->name . '. Jumlah uang: ' . $student->golds . '. Jumlah Exp: ' . $student->total_exp . '. Progress story: ' . $student->story_level_progress . '. Level: ' . $student->exp_id,
                    'log_path'=>'/battle/' . $id . '/' . $mode . '/' . $answerCorrect . '/' . $questionId . '/' . $userHealth . '/' . $firstAnim . '/' . $abyssScore . '/' . $useItem . '/' . $countdown . '/' . $lastQuestionId,
                    'log_ip'=>UserSystemInfoHelper::get_ip(),
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
                    'abyssScore'=>'n',
                    'studentItem'=>$studentItem,
                    'countdown'=>$countdown
                ]);
            }

            $randomizedQuestion = $question->random();

            if($lastQuestionId != 'n'){
                $randomizedQuestion = $question[$lastQuestionId];
            }
            
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
                'abyssScore'=>'n',
                'studentItem'=>$studentItem,
                'countdown'=>$countdown
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

                GameLog::create([
                    'table'=>'senrup_students',
                    'student_id'=>$student->student_id,
                    'log_desc'=>'Status student ' . $student->user->name . '. Jumlah uang: ' . $student->golds . '. Jumlah Exp: ' . $student->total_exp . '. Point abyss: ' . $student->abyss_point . '. Level: ' . $student->exp_id,
                    'log_path'=>'/battle/' . $id . '/' . $mode . '/' . $answerCorrect . '/' . $questionId . '/' . $userHealth . '/' . $firstAnim . '/' . $abyssScore . '/' . $useItem . '/' . $countdown . '/' . $lastQuestionId,
                    'log_ip'=>UserSystemInfoHelper::get_ip(),
                ]);

                $student->update([
                    'golds'=>$golds,
                    'total_exp'=>$totalExp,
                    'exp_id'=>$expId,
                    'abyss_point'=>$studentAbyssScore
                ]);

                GameLog::create([
                    'table'=>'senrup_students',
                    'student_id'=>$student->student_id,
                    'log_desc'=>'Status student ' . $student->user->name . '. Jumlah uang: ' . $student->golds . '. Jumlah Exp: ' . $student->total_exp . '. Point abyss: ' . $student->abyss_point . '. Level: ' . $student->exp_id,
                    'log_path'=>'/battle/' . $id . '/' . $mode . '/' . $answerCorrect . '/' . $questionId . '/' . $userHealth . '/' . $firstAnim . '/' . $abyssScore . '/' . $useItem . '/' . $countdown . '/' . $lastQuestionId,
                    'log_ip'=>UserSystemInfoHelper::get_ip(),
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
                    'abyssScore'=>$abyssScore,
                    'studentItem'=>$studentItem,
                    'countdown'=>$countdown
                ]);
            }

            $randomizedQuestion = $questions->random();

            if($lastQuestionId != 'n'){
                $randomizedQuestion = $questions[$lastQuestionId];
            }

            $battleQuestionId = $questions->search($randomizedQuestion);

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
                'battleQuestionId'=>$battleQuestionId,
                'questionId'=>$questionId,
                'firstAnim'=>$firstAnim,
                'battleStatus'=>$battleStatusAbyss,
                'rewards'=>[floor($abyssScore * 0.1), floor($abyssScore * 0.003)],
                'abyssScore'=>$abyssScore,
                'studentItem'=>$studentItem,
                'countdown'=>$countdown
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
