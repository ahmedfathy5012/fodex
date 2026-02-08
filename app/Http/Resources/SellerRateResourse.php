<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SellerRateResourse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => intval($this->id),
            'image' => $this->image ? asset('uploads/'.$this->image) : '',
            'comment' => $this->comment ? $this->comment : '',
            'rate' => $this->rate,
            "user_name" => $this->user ? $this->user->name : '' ,
            'duration' => $this->created_at
            ];
    }
}
