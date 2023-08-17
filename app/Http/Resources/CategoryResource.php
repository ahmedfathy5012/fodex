<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      //  dd($request->all());
       return [
            'id' => intval($this->id),
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->image ? asset('uploads/'.$this->image) : '',
            'sub_categories' => SubcategoryResource::collection($this->subcategories),
            'items' => (count($this->subcategories)  >  0 ) ? [] : ItemResource::collection($this->items()->where('seller_id',$request->seller_id)->get()) 
            ];
    }
}
