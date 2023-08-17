<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class latlonResource extends JsonResource
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
            'lat' => $this->lat ?? "",
            'lon' => $this->lon ?? "",
            ];
    }
}
