<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return response()->json([
            'success' => true,
            'message' => 'Data ditemukan',
            'data' => $posts
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:100',
            'content' => 'required|string',
        ]);

        $post = Post::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Sukses melakukan create data',
            'data' => $post
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data ditemukan',
            'data' => $post
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:100',
            'content' => 'required|string',
        ]);

        $post->update($validatedData);

        return response()->json([
            'success' => true,
            'data' => $post
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $post->delete();

        return response()->json([
            'success' => true,
            'message' => 'Sukses melakukan delete data',
            'data' => $post
        ], 200);
    }
}
