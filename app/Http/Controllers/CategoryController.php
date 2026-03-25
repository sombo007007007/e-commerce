<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use Carbon\Carbon;

class CategoryController extends Controller
{
    public function index_category()
    {
        try{
            $category_index = Categories::all();
            return response()->json([
                'Payloads' => $category_index
            ], 200);

        }catch(\Exception $e){
            return Response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function store_category(Request $request)
    {
        try{
            $request->validate([
                'name' =>'required|string|max:255',
            ],[],[
                'name.required' => 'Name is required',
            ]);
            $categories_store = new Categories();
            $categories_datatime = Carbon::now();
            $payloads_category = $categories_store->create([
                'name' => $request->name,
                'created_at' => $categories_datatime
            ]);
            return response()->json([
                'message' => 'Store category successfully',
                'payloads' => $payloads_category
            ], 200);

        }catch(\Exception $e){
            return Response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function edit_category($category_id)
    {
        try{
            $category_index = Categories::find($category_id);
            return response()->json([
                'Payloads' => $category_index
            ], 200);

        }catch(\Exception $e){
            return Response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function update_category(Request $request, $category_id)
    {
        try{
            $request->validate([
                'name' =>'required|string|max:255',
            ],[],[
                'name.required' => 'Name is required',
            ]);
            $category_update = Categories::find($category_id);
            $categories_datatime_up = Carbon::now();
            $category_update->update([
                'name' => $request->name,
                'updated_at' => $categories_datatime_up
            ]);
            return response()->json([
                'message' => 'Update Successfully'
            ], 200);
        }catch(\Exception $e){
            return Response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function destroy_category( $category_id)
    {
        try{
            $category_deleted=Categories::find($category_id);
            $category_deleted->delete();
            return response()->json([
                'message' => 'Delete Successfully'
            ], 200);
        }catch(\Exception $e){
            return Response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
