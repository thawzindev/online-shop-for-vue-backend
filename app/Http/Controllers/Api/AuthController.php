<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Carbon\Carbon;
use App\User;
use App\UserWishList;
use Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        
    	$validator = Validator::make($request->all(), [
            'phone' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors()->first()], 422);
        }

        $user = User::where('phone', $request->phone)->where('role', 99)->first();

        if (!$user) {
        	return response()->json(['error' => 'no account!'], 422);
        }

        $wishList = UserWishList::where('user_id', $user->id)->count();

        $check = Hash::check($request->password, $user->password);

        $user['wishList'] = $wishList;

        if ($check) {
        	$token = $user->createToken('user-token');
            $expire_at = Carbon::now()->addDays(1);
			$user['token'] = $token->plainTextToken;
            $user['expire_at'] = $expire_at; 
			return response()->json($user,200);
        }

        return response()->json(['error' => 'Wrong Password!'], 422);
    }
}
