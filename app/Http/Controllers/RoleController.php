<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
// use Carbon\Carbon;

class RoleController extends Controller
{
    public function role_store(Request $request){
        try{
            $roles_store = new Role();
            // dd($roles_store);
            $request->validate([
                'name' => 'required|unique:roles,name',
            ],[],[
                'name.unique' => 'Role name already exists '
            ]);
            // $role_datatime = Carbon::now();
            $store_role = $roles_store->create([
                'name' => $request->name,
                'description' =>$request->description,
            ]);
            return response()->json([
                'message' => 'Store Successfully',
                'payloads' => $store_role
                ]);
        }catch (\Exception $e){
            return Response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
