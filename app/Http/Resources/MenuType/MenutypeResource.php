<?php

namespace App\Http\Resources\MenuType;

use App\Models\MenuType;
use Illuminate\Http\Resources\Json\JsonResource;

class MenutypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /**
         * @var MenuType $menuType
         */
        $menuType = $this->resource;
        return [
            'id' => $menuType->id,
            'title' => $menuType->title ?? '',
        ];
    }
}
