<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
   public function store(Request $request)
{
    try {
        // ✅ Validate request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // ✅ Create user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        // ✅ Successful JSON response
        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'data' => $user,
        ], 201);

    } 
      catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
            'data' => null
        ], $e->getCode() ?: 500);
    }
}


  public function update(Request $request,$id)
{
    try {
        // ✅ Validate request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        // ✅ Create user
        $user = User::where('id',$id)->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        // ✅ Successful JSON response
        return response()->json([
            'success' => true,
            'message' => 'User updated successfully',
            'data' => $user,
        ], 201);

    } 
      catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
            'data' => null
        ], $e->getCode() ?: 500);
    }
}

public function index()
{
   $user = User::all();

  return response()->json([
    'success' => true,
    'message' => 'User retrieved successfully',
    'data' => $user,
  ]);

}

public function delete($id)
{
    try {
        $user = User::where('id',$id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully',
            'data' => $user,
        ], 200);

    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json([
            'success' => false,
            'message' => 'User not found',
            'data' => null,
        ], 404);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to delete user',
            'error' => $e->getMessage(),
        ], 500);
    }
}


  

}
