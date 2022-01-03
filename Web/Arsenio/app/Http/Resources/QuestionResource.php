<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $answers = collect([]);

        $answers->push($this->correct_answer);
        $answers->push($this->answer_b);
        $answers->push($this->answer_c);
        $answers->push($this->answer_d);     
        
        $randomizedAnswer = collect([]);
        while($randomizedAnswer->count() < 4 || $randomizedAnswer == null){
            $answer = $answers->random();

            if($randomizedAnswer->contains($answer) == false){
                $randomizedAnswer->push($answer);
            }
        }

        return [
            'question'=>$this->question,
            'answer_a'=>$randomizedAnswer[0],
            'answer_b'=>$randomizedAnswer[1],
            'answer_c'=>$randomizedAnswer[2],
            'answer_d'=>$randomizedAnswer[3],
            'correct_answer'=>$this->correct_answer
        ];
    }
}
