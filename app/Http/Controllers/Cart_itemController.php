<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart_items;

class Cart_itemController extends Controller
{
    public function index_cart_item()
    {
        $cart_item = Cart_items::all();
        return response()->json([
            'status' => 'success',
            'message' => 'Cart item retrieved successfully',
            'data' => $cart_item
        ]);
    }

    public function store_cart_item(Request $request)
    {
        try {
            $cart_item = new Cart_items();

            $payloads_cartitem = $cart_item->create([
                'cart_id' => $request->cart_id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Cart item created successfully',
                'data' => $payloads_cartitem
            ]);
        } catch (\Exception $e) {
            return Response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function edit_cart_item($cart_item_id)
    {
        $cart_item = Cart_items::where('id', $cart_item_id)->first();
        return response()->json([
            'status' => 'success',
            'message' => 'Cart item retrieved successfully',
            'data' => $cart_item
        ]);
    }

    public function update_cart_item(Request $request, $cart_item_id)
    {
        $cart_item = Cart_items::where('id', $cart_item_id)->first();
        $cart_item->update([
            'cart_id' => $request->cart_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Cart item updated successfully',
            'data' => $cart_item
        ]);
    }

    public function destroy_cart_item($cart_item_id)
    {
        $cart_item = Cart_items::where('id', $cart_item_id)->first();
        $cart_item->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Cart item deleted successfully',
            'data' => $cart_item
        ]);
    }
}
