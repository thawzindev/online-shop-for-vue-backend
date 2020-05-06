<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\User;
use App\Order;
use App\OrderProduct;

class CheckOutController extends Controller
{
    public function index(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'apartment' => 'required',
            'township' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'create_account' => 'nullable',
            'account_pw' => 'nullable',
            'notes' => 'nullable',
            'cash_on_delivery' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors()->first()], 422);
        }

        if ($request->create_account) {
            $user = User::create([
                        'name'  => $request->name,
                        'address'   => $request->address,
                        'apartment' => $request->apartment,
                        'township' => $request->township,
                        'phone' => $request->phone,
                        'email' => $request->email,
                        'password'  => bcrypt($request->account_pw),
                    ]);
        }

        if ($request->create_account) {
            $order = Order::create([
                'user_id'   => $user->id,
                'notes'  => $request->notes,
            ]);

        } else {
            $order = Order::create([
                'name'  => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address'   => $request->address,
                'apartment' => $request->apartment,
                'township'  => $request->township,
                'notes' => $request->notes
            ]);
        }

        foreach ($request->products as $key => $product) {
            OrderProduct::create([
                'order_id'  => $order->id,
                'product_id'    => $product['id'],
                'quantity'  => $product['quantity'],
            ]);
        }



    	return response()->json(['data' => 'success']);

    }
}
