<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
   public function store(Request $request)
   {
       try{
        $validated = $request->validate([
            "user_id" => "required|exists:users,id",
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image_url' => 'string|nullable',
        ]);
        $post = Post::create([
            'user_id' => $validated['user_id'],
            'title' => $validated['title'],
            'content' => $validated['content'],
            'image_url' => $validated['image_url'] ?? null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Post created successfully',
            'data' => $post,
        ],201);
       }
       catch(\Exception $e){
        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
            'data' => null
        ], $e->getCode() ?: 500);
       }
   }

   public function index()
   {
        try{
            $post = Post::all();

            return response()->json([
                'success' => true,
                'message' => 'Posts retrieved successfully',
                'data' => $post,
            ],200);
        }
        catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], $e->getCode() ?: 500);
        }
   }

   public function delete($id)
   {
        try{
            $post = Post::where('id', $id)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Post deleted successfully',
                'data' => $post,
            ],200);
        }
        catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], $e->getCode() ?: 500);
        }
   }

   public function update(Request $request, $id)
   {
        try{
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'image_url' => 'string|nullable',
            ]);

            $post = Post::where('id', $id)->update([
                'title' => $validated['title'],
                'content' => $validated['content'],
                'image_url' => $validated['image_url'] ?? null,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Post updated successfully',
                'data' => $post,
            ],200);
        }
        catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], $e->getCode() ?: 500);
        }
   }

}
