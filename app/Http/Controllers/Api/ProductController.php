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

        // $data = Product::get();

        // foreach ($data as $key => $value) {
        //     $value->category_id = rand(1,3);
        //     $rand = rand(1, 5);

        //     if ($rand == 1) {
        //         $value->product_image = 'https://www.planetorganic.com/images/products/large/1874.jpg';
        //     } elseif ($rand == 2) {
        //         $value->product_image =  'https://i5.walmartimages.ca/images/Enlarge/094/514/6000200094514.jpg';
        //     } elseif ($rand == 3) {
        //         $value->product_image =  'https://avocadosfrommexico.com/wp-content/uploads/2016/11/avocado-hub.jpg';
        //     } elseif ($rand == 4) {
        //         $value->product_image =  'https://www.planetorganic.com/images/products/large/1874.jpg';
        //     } elseif ($rand == 5) {
        //         $value->product_image =  'https://images-na.ssl-images-amazon.com/images/I/71ogcdh7YjL._AC_SY450_.jpg';
        //     }

        //     $value->save();
        // }
 
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
