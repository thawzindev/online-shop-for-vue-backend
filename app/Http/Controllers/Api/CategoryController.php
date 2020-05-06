<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function index()
    {
    	$data = Category::get();
    	return response()->json(['data' => $data]);
    }

    public function find($uuid)
    {
    	$data = Category::where('category_uuid', $uuid)->with('getProducts')->first();
    	if (!$data) {
    		return  response()->json(['error' => 'category not found!'], 422);
    	}
    	return response()->json(['data' => $data], 200);
    }
}
