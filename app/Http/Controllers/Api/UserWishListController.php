<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UserWishList;
use Validator;
use App\Http\Resources\UserWishListResource;

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

    public function wishList()
    {
        $data = UserWishList::where('user_id', auth()->id())->with('wishListItem')->get();

        return UserWishListResource::collection($data);
    }

    public function wishListDelete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors()->first()], 422);
        }

        $data = UserWishList::find($request->id);
        $data->delete();

        return response()->json('success', 200);

    }
}
