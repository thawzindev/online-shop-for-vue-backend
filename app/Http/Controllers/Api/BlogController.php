<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Blog;

class BlogController extends Controller
{
    public function index()
    {
    	$data = Blog::where('status', 1)->paginate(10);
    	return response()->json(['data' => $data], 200);
    }

    public function getFeatureBlog()
    {
    	$data = Blog::where('status', 1)->where('is_feature', 1)->get();
    	return response()->json(['data' => $data], 200);
    }
}
