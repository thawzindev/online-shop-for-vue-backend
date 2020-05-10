<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UserWishList;
use Validator;

class UserWishListController extends Controller
{
    public function addToWishList(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'product_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors()->first()], 422);
        }

        UserWishList::create([
        	'user_id'	=> auth()->id(),
        	'product_id'	=> $request->product_id
        ]);

        $data = UserWishList::where('user_id', auth()->id())->count();

        return response()->json(['count' => $data], 200);
    }
}
