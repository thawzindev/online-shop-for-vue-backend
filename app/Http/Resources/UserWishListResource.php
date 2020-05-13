<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserWishListResource extends JsonResource
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
            'product_id'  => $this->wishListItem->id,
            'product_name'  => $this->wishListItem->product_name,
            'product_image' => $this->wishListItem->product_image,
            'description'   => $this->wishListItem->description,
            'price'   => $this->wishListItem->price,
            'in_stock'  => $this->wishListItem->in_stock,
            'stock'     => $this->wishListItem->stock,
            'created_at'    => $this->created_at->format('d-m-Y h:i:s A')
        ];
    }
}
