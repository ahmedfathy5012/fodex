<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\latlonResource;
class ZoneResource extends JsonResource
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
            'title' => $this->name ?? "",
            "areas"  => latlonResource::collection($this->areas)
            ];
    }
}
