<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BoxResource extends JsonResource
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
            //  'id' => intval($this->id),
            'id' => intval($this->id),
            'image' => $this->image ? asset("uploads/".$this->image) : "",
            "code" => $this->code ?? "",
            "status" => $this->box_status->title ?? ""
            ];
    }
}
