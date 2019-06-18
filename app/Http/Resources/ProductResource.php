<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'manufacturer_name' => $this->manufacturer_name,
            'category_name' => $this->category_name,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'status' => $this->status,
            'price' => $this->price,
            'manufacturer_id' => $this->manufacturer_id,
            'category_id' => $this->category_id,
            'details' => DetailResource::collection($this->details),
            'pictures' => PictureResource::collection($this->pictures),
        ];
    }
}
