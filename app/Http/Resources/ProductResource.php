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
    public function toArray($request)
    {
        return [
            'id'    => $this->id,
            'category_id'   => $this->category_id ?? '',
            'category'  => $this->category->name_en ?? '',
            'uuid'  =>  $this->uuid,
            'product_name'  => $this->product_name,
            'product_image' => $this->product_image ?? '',
            'department'    => $this->department,
            'description'   => $this->description,
            'price'     => $this->price,
            'in_stock'  => $this->in_stock,
            'stock' => $this->stock,
        ];
    }
}
