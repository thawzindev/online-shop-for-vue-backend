<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Blog;
use App\Http\Resources\BlogResource;

class BlogController extends Controller
{
    public function index()
    {
    	$data = Blog::where('status', 1)->paginate(9);
    	return BlogResource::collection($data);
    }

    public function getFeatureBlog()
    {
    	$data = Blog::where('status', 1)->where('is_feature', 1)->take(3)->get();
    	return response()->json(['data' => $data], 200);
    }

    public function detail($id)
    {
        $data = Blog::find($id);
        return response()->json($data);
    }

    public function suggestBlog()
    {
        $data = Blog::latest()->take(3)->get();
        return response()->json(['data' => $data], 200);
    }
}
