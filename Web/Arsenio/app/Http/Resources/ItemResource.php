<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
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
            'item_id'=>$this->item_id,
            'name'=>$this->name,
            'image'=>$this->image,
            'amount'=>$this->amount,
            'single_price'=>$this->single_price,
            'description'=>$this->description,
        ];
    }
}
