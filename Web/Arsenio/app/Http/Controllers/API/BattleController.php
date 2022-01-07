<?php

namespace App\Http\Controllers\API;

use App\Helpers\UserSystemInfoHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\BattleRewardResource;
use App\Http\Resources\BattleStudentDataResource;
use App\Http\Resources\EnemyResource;
use App\Http\Resources\QuestionResource;
use App\Models\CharacterExp;
use App\Models\Enemy;
use App\Models\GameLog;
use App\Models\ItemStudentRelation;
use App\Models\LevelRewardRelation;
use App\Models\Question;
use App\Models\StoryLevel;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BattleController extends Controller
{
    //
    public function index($levelId){
        $student = Student::where('user_id', Auth::user()->id)->get();
        $storyLevel = StoryLevel::where('level_id', $levelId)->first();

        if($levelId == 0){
            GameLog::create([
                'table'=>'senrup_students',
                'student_id'=>$student[0]->student_id,
                'log_desc'=>'User ' . $student[0]->user->name . ' masuk battle abyss',
                'log_path'=>'/battle/' . $levelId,
                'log_ip'=>UserSystemInfoHelper::get_ip(),
            ]);

            $enemy = Enemy::where('name', 'Iblis Kekal')->first();

            return [
                'battleStudentData'=>BattleStudentDataResource::collection($student),
                'enemy'=>new EnemyResource($enemy)
            ];
        }else{
            GameLog::create([
                'table'=>'senrup_students',
                'student_id'=>$student[0]->student_id,
                'log_desc'=>'User ' . $student[0]->user->name . ' masuk battle story level ' . $levelId,
                'log_path'=>'/battle/' . $levelId,
                'log_ip'=>UserSystemInfoHelper::get_ip(),
            ]);
        }
        
        return [
            'battleStudentData'=>BattleStudentDataResource::collection($student),
            'enemy'=>new EnemyResource($storyLevel->enemy)
        ];
    }

    public function storyShow($levelId, $questionIndex){
        $questions = Question::where('level_id', $levelId)->get();

        return [
            'question'=>new QuestionResource($questions[$questionIndex]),
            'questionAmount'=>count($questions)
        ];
    }

    public function storyUpdate($levelId){
        $student = Student::where('user_id', Auth::user()->id)->first();
        $rewards = LevelRewardRelation::where('level_id', $levelId)->get();

        $golds = $student->golds;
        $totalExp = $student->total_exp;
        $storyLevelProgress = $student->story_level_progress;
        $expId = $student->exp_id;

        GameLog::create([
            'table'=>'senrup_students',
            'student_id'=>$student->student_id,
            'log_desc'=>'User ' . $student->user->name . ' telah menyelesaikan story level ' . $levelId . '. Gold user: ' . $golds . '. Total exp user: ' . $totalExp . '. Progres level story user: ' . $storyLevelProgress . '. Level Karakter: ' . $expId,
            'log_path'=>'/battle/' . $levelId,
            'log_ip'=>UserSystemInfoHelper::get_ip(),
        ]);

        $goldReward = $rewards[0]->reward_amount;
        $expReward = $rewards[1]->reward_amount;

        if($student->story_level_progress == $levelId){
            $golds += $goldReward;
            $totalExp += $expReward;
            
            if($storyLevelProgress % 5 == 0){
                $storyLevelProgress += 6;
            }else{
                $storyLevelProgress += 1;
            }

        }else{
            $goldReward = $rewards[0]->reward_amount / 2;
            $expReward = $rewards[1]->reward_amount / 2;

            $golds += floor($goldReward);
            $totalExp += floor($expReward);
        }

        GameLog::create([
            'table'=>'senrup_rewards',
            'student_id'=>$student->student_id,
            'log_desc'=>'Rewards story level ' . $levelId . '. Gold: ' . $goldReward . '. Exp ' . $expReward,
            'log_path'=>'/battle/' . $levelId,
            'log_ip'=>UserSystemInfoHelper::get_ip(),
        ]);

        $exp = CharacterExp::where('level_up_exp', '<=', $totalExp)
                ->orderBy('level_up_exp', 'desc')
                ->first();

        if($exp != null){
            $expId = $exp->exp_id;

            if($exp->level_up_exp <= $totalExp){
                $expId = $exp->exp_id + 1;
            }
        }

        $student->update([
            'golds'=>$golds,
            'total_exp'=>$totalExp,
            'story_level_progress'=>$storyLevelProgress,
            'exp_id'=>$expId
        ]);

        $student = Student::where('user_id', Auth::user()->id)->first();

        $golds = $student->golds;
        $totalExp = $student->total_exp;
        $storyLevelProgress = $student->story_level_progress;
        $expId = $student->exp_id;

        GameLog::create([
            'table'=>'senrup_students',
            'student_id'=>$student->student_id,
            'log_desc'=>'User ' . $student->user->name . ' telah menyelesaikan story level ' . $levelId . '. Gold user: ' . $golds . '. Total exp user: ' . $totalExp . '. Progres level story user: ' . $storyLevelProgress . '. Level Karakter: ' . $expId,
            'log_path'=>'/battle/' . $levelId,
            'log_ip'=>UserSystemInfoHelper::get_ip(),
        ]);
        
        return [
            'gold_rewards'=>floor($goldReward),
            'exp_rewards'=>floor($expReward)
        ];
    }

    public function abyssShow($questionIndex){
        $questions = Question::all();

        return [
            'question'=>new QuestionResource($questions[$questionIndex]),
            'questionAmount'=>count($questions)
        ];
    }

    public function abyssUpdate($battleScore){
        $student = Student::where('user_id', Auth::user()->id)->first();

        $golds = $student->golds;
        $totalExp = $student->total_exp;
        $expId = $student->exp_id;
        $score = $student->abyss_point;

        GameLog::create([
            'table'=>'senrup_students',
            'student_id'=>$student->student_id,
            'log_desc'=>'User ' . $student->user->name . ' telah menyelesaikan abyss. Gold user: ' . $golds . '. Total exp user: ' . $totalExp . '. Point abyss user: ' . $score . '. Level Karakter: ' . $expId,
            'log_path'=>'/abyss/battle/' . $battleScore,
            'log_ip'=>UserSystemInfoHelper::get_ip(),
        ]);

        $goldReward = $battleScore * 0.1;
        $expReward = $battleScore * 0.003;

        GameLog::create([
            'table'=>'senrup_rewards',
            'student_id'=>$student->student_id,
            'log_desc'=>'Rewards abyss. Gold: ' . $goldReward . '. Exp ' . $expReward,
            'log_path'=>'/abyss/battle/' . $battleScore,
            'log_ip'=>UserSystemInfoHelper::get_ip(),
        ]);
        
        $golds += $goldReward;
        $totalExp += $expReward;

        $exp = CharacterExp::where('level_up_exp', '<=', $totalExp)
                ->orderBy('level_up_exp', 'desc')
                ->first();

        if($exp != null){
            $expId = $exp->exp_id;

            if($exp->level_up_exp <= $totalExp){
                $expId = $exp->exp_id + 1;
            }
        }

        if($battleScore > $score){
            $score = $battleScore;
        }

        $student->update([
            'golds'=>$golds,
            'total_exp'=>$totalExp,
            'abyss_point'=>$score,
            'exp_id'=>$expId
        ]);

        $student = Student::where('user_id', Auth::user()->id)->first();

        $golds = $student->golds;
        $totalExp = $student->total_exp;
        $expId = $student->exp_id;
        $score = $student->abyss_point;

        GameLog::create([
            'table'=>'senrup_students',
            'student_id'=>$student->student_id,
            'log_desc'=>'User ' . $student->user->name . ' telah menyelesaikan abyss. Gold user: ' . $golds . '. Total exp user: ' . $totalExp . '. Point abyss user: ' . $score . '. Level Karakter: ' . $expId,
            'log_path'=>'/abyss/battle/' . $battleScore,
            'log_ip'=>UserSystemInfoHelper::get_ip(),
        ]);
        
        return [
            'gold_rewards'=>floor($goldReward),
            'exp_rewards'=>floor($expReward)
        ];
    }

    public function battleItemUpdate($bandageAmount, $jamuAmount, $hourglassAmount){
        $student = Student::where('user_id', Auth::user()->id)->first();
        
        ItemStudentRelation::where('student_id', $student->student_id)
                        ->where('item_id', 1)->update([
                            'item_owned'=>$bandageAmount
                        ]);

        ItemStudentRelation::where('student_id', $student->student_id)
                        ->where('item_id', 2)->update([
                            'item_owned'=>$jamuAmount
                        ]);

        ItemStudentRelation::where('student_id', $student->student_id)
                        ->where('item_id', 3)->update([
                            'item_owned'=>$hourglassAmount
                        ]);

        $itemStudent = ItemStudentRelation::where('student_id', $student->student_id)->get();

        GameLog::create([
            'table'=>'senrup_students',
            'student_id'=>$student->student_id,
            'log_desc'=>'User ' . $student->user->name . ' menggunakan item. Sisa item sebagai berikut. Jumlah perban user: ' . $itemStudent[0]->item_owned . '. Jumlah jamu user: ' . $itemStudent[1]->item_owned . '. Jumlah jam pasir user: ' . $itemStudent[2]->item_owned,
            'log_path'=>'/battle/' . $bandageAmount . '/' . $jamuAmount . '/' . $hourglassAmount,
            'log_ip'=>UserSystemInfoHelper::get_ip(),
        ]);

        return [
            'message'=>'Student items updated successfully'
        ];
    }
}
