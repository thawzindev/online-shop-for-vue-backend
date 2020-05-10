<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    public function index()
    {
 
    	$data = Product::paginate(9);
        // return response()->json(['data' => $data]);
    	return ProductResource::collection($data);
    }

    public function find($uuid)
    {
    	$data = Product::where('id', $uuid)->first();
        // return $data;
        $data['category'] = $data->category->name_en;
        // sleep(3);
    	return response()->json($data);
    }

    public function getAllProducts($id)
    {
        $data = Product::where('category_id', $id)->paginate(20);
        return ProductResource::collection($data);
    }

    public function checkProduct($id)
    {
        $data = Product::find($id);
        // return $data;
        if ($data->stock > 0  && $data->in_stock) {
            return response()->json(['status' => true]);
        }

        // return response()->json(['status' => false]);
    }

    public function featureProducts()
    {
        $data = Product::where('is_feature', 1)->get();
        return response()->json(['data' => $data], 200);
    }
}
