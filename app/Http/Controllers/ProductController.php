<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function index_product()
    {
        try {
            $product = Products::all();
            return response()->json([
                'status' => true,
                'message' => 'Product list',
                'data' => $product
            ], 200);
        }
        catch (\Exception $e) {
            return Response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function store_product(Request $request)
    {
        try {
            $request->validate([
                'image' => 'required',
                'name' => 'required',
                'price' => 'required',
                'stock' => 'required',
                'category_id' => 'required'
            ], [], [
                'image' => 'required image',
                'name' => 'required name',
                'price' => 'required price',
                'stock' => 'required stock',
                'category_id' => 'required category'
            ]);
            $product_datatime = Carbon::now();
            $store_product = new Products();
            $image = '';
            if ($request->hasFile('image')) {
                $image_file = $request->file('image');
                $image_name = time() . '.' . $image_file->getClientOriginalExtension();
                $image_file->move(public_path('images'), $image_name);
                $image = $image_name;
            }

            $payloads_product = $store_product->create([
                'image' => $image,
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'stock' => $request->stock,
                'category_id' => $request->category_id,
                'created_at' => $product_datatime,
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Products Successfully',
                'payloads' => $payloads_product
            ], 200);
        }
        catch (\Exception $e) {
            return Response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function edit_product($product_id)
    {
        try {
            $product_edit = Products::find($product_id);
            if ($product_edit) {
                return response()->json([
                    'status' => true,
                    'message' => 'Product edit',
                    'data' => $product_edit
                ], 200);
            }
            else {
                return response()->json([
                    'status' => false,
                    'message' => 'Product not found'
                ], 404);
            }
        }
        catch (\Exception $e) {
            return Response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function update_product(Request $request, $product_id)
    {
        try {
            $product_update = Products::find($product_id);
            $image = '';
            if ($request->hasFile('image')) {
                $image_file = $request->file('image');
                $image_name = time() . '.' . $image_file->getClientOriginalExtension();
                $image_file->move(public_path('images'), $image_name);
                $image = $image_name;
            }
            $update_datatime = Carbon::now();
            if ($product_update) {
                $product_update->update([
                    'image' => $image,
                    'name' => $request->name,
                    'description' => $request->description,
                    'price' => $request->price,
                    'stock' => $request->stock,
                    'category_id' => $request->category_id,
                    'updated_at' => $update_datatime
                ]);
                return response()->json([
                    'status' => true,
                    'message' => 'Product updated Successfully',
                    'data' => $product_update
                ], 200);
            }
            else {
                return response()->json([
                    'status' => false,
                    'message' => 'Product not found'
                ], 404);
            }
        }
        catch (\Exception $e) {
            return Response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function destroy_product($product_id)
    {
        try {
            $product_destroy = Products::find($product_id);
            if ($product_destroy) {
                $product_destroy->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Product deleted Successfully'
                ], 200);
            }
            else {
                return response()->json([
                    'status' => false,
                    'message' => 'Product not found'
                ], 404);
            }
        }
        catch (\Exception $e) {
            return Response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}