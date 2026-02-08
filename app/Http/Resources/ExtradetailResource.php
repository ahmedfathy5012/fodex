<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExtradetailResource extends JsonResource
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
            'price' =>intval($this->extra_price),
            'default' => intval($this->default_new),
            'currency' => $this->extra->item ? $this->extra->item->currency : ''];
    }
}
