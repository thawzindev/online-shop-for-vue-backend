<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function index()
    {
    	$data = Product::paginate(20);
    	return response()->json(['data' => $data]);	
    }
}
