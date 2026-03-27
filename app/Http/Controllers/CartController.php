<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index_cart(){
        $cart = Carts::where('user_id', auth()->id())->first();
        if($cart){
            return response()->json([
                'status' => 'success',
                'message' => 'Cart retrieved successfully',
                'data' => $cart
            ]);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Cart not found',
            'data' => null
        ]);
    }

    public function store_cart(Request $request){
        $cart = Carts::where('user_id', auth()->id())->first();
        if($cart){
            return response()->json([
                'status' => 'success',
                'message' => 'Cart retrieved successfully',
                'data' => $cart
            ]);
        }else{
            $cart = Carts::create([
                'user_id' => auth()->id(),
                'created_at' => now(),
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Cart created successfully',
                'data' => $cart
            ]);
        }
    }

    public function edit_cart($cart_id){
        $cart = Carts::where('id', $cart_id)->first();
        if($cart){
            return response()->json([
                'status' => 'success',
                'message' => 'Cart retrieved successfully',
                'data' => $cart
            ]);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Cart not found',
            'data' => null
        ]);
    }

    public function update_cart(Request $request, $cart_id){
        $cart = Carts::where('id', $cart_id)->first();
        if($cart){
            $cart->update([
                'user_id' => auth()->id(),
                'created_at' => now(),
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Cart updated successfully',
                'data' => $cart
            ]);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Cart not found',
            'data' => null
        ]);
    }
}
