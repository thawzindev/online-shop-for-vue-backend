<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserWishList extends Model
{
    protected $guarded = [];

    public function wishListItem()
    {
    	return $this->belongsTo(Product::class, 'product_id');
    }
}
