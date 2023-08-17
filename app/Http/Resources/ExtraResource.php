<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExtraResource extends JsonResource
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
             'id' => $this->id,
            'title' => $this->title,
          //  'price' =>intval($this->price),
          'count_number' => intval($this->count_number),
          'multiple' => intval($this->multiple),
            'extraDetails' => ExtradetailResource::collection($this->extraDetails)];
    }
}
