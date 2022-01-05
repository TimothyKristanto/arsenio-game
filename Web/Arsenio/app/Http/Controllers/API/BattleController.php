<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BattleRewardResource;
use App\Http\Resources\BattleStudentDataResource;
use App\Http\Resources\EnemyResource;
use App\Http\Resources\QuestionResource;
use App\Models\CharacterExp;
use App\Models\Enemy;
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
            $enemy = Enemy::where('name', 'Iblis Kekal')->first();

            return [
                'battleStudentData'=>BattleStudentDataResource::collection($student),
                'enemy'=>new EnemyResource($enemy)
            ];
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

        $goldReward = $battleScore * 0.1;
        $expReward = $battleScore * 0.003;
        
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
        
        return [
            'gold_rewards'=>floor($goldReward),
            'exp_rewards'=>floor($expReward)
        ];
    }
}
