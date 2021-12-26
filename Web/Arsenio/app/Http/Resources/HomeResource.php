<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HomeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'student_id'=>$this->student_id,
            'golds'=>$this->golds,
            'total_exp'=>$this->total_exp,
            'abyss_point'=>$this->abyss_point,
            'exp_id'=>$this->exp_id,
            'user_id'=>$this->user_id,
            'story_level_progress'=>$this->story_level_progress,
            'level_up_exp'=>$this->characterExp->level_up_exp,
            'username'=>$this->user->name
        ];
    }
}
