<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function getProducts()
    {
    	return $this->hasMany(Product::class, 'category_id');
    }
}
