<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderControlelr extends Controller
{
    public function index_order(){
        $order = DB::table('orders')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->select('orders.*', 'users.name','users.email')
        ->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Order list',
            'data' => $order,
        ]);
    }
    public function store_order(Request $request){
        try{

            $request->validate([
                'user_id' => 'required',
                'total_price' => 'required',
                'status' => 'required',
            ],[
                'user_id.required' => 'User ID is required',
                'total_price.required' => 'Total Price is required',
                'status.required' => 'Status is required',
            ]);

            $order = new Orders();
            $order_datatime = Carbon::now();
            $order_store = $order->create([
                'user_id' => auth()->id(),
                'total_price' => $request->total_price,
                'status' => $request->status,
                'created_at' => $order_datatime,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Order created',
                'data' => $order_store,
            ]);
        }catch(\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Order not created',
                'data' => $e->getMessage(),
            ], 500);
        }
    }
    public function edit_order($order_id){
        $order = DB::table('orders')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->select('orders.*', 'users.name','users.email')
        ->where('orders.id', $order_id)
        ->get();
        if($order){
            return response()->json([
                'status' => 'success',
                'message' => 'Order retrieved successfully',
                'data' => $order,
            ],200);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Order not found',
                'data' => null,
            ],404);
        }
    }
    public function update_order(Request $request, $order_id){
        try{
            // $request->validate([
            //     'user_id' => 'required',
            //     'total_price' => 'required',
            //     'status' => 'required',
            // ],[
            //     'user_id.required' => 'User ID is required',
            //     'total_price.required' => 'Total Price is required',
            //     'status.required' => 'Status is required',
            // ]);

            $order = Orders::where('id', $order_id)->first();
            if($order){
                $update_orderdatatime = Carbon::now();
                $order->update([
                    'user_id'     => $request->user_id     ?? $order->user_id,
                    'total_price' => $request->total_price ?? $order->total_price,
                    'status'      => $request->status      ?? $order->status,
                    'updated_at'  => $update_orderdatatime,
                ]);
                $order->refresh();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Order updated successfully',
                    'data' => $order,
                ],200);
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'Order not found',
                    'data' => null,
                ],404);
            }
        }catch(\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Order not updated',
                'data' => $e->getMessage(),
            ], 500);
        }
    }
    public function destroy_order($order_id){
        try{
            $order = Orders::where('id', $order_id)->first();
            if($order){
                $order->delete();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Order deleted successfully',
                    'data' => $order,
                ],200);
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'Order not found',
                    'data' => null,
                ],404);
            }
        }catch(\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Order not deleted',
                'data' => $e->getMessage(),
            ], 500);
        }
    }
}
