<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{
    use AuthorizesRequests;
    public function index() {
        $posts = Post::get();
        $posts=$posts->map(function($post) {
            return [
                'id' => $post->id,
                'title' => $post->title,
                'content' => $post->content,
                'user_name' => $post->user->name,
            ];
        });
        return response()->json($posts);
    }

    public function show(string $id){
        
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        $postData = [
            'id' => $post->id,
            'title' => $post->title,
            'content' => $post->content,
        'user' => [
            'name' => $post->user->name,
            'image' => $post->user->image,
        ],
        'category' => [
            'name' => $post->category->name,
        ],
        'tags' => $post->tags->pluck('name')->toArray(),
        'comments' => $post->comments->map(function($comment){
            return [
                'id' => $comment->id,
                'content' => $comment->content,
                'user' => [
                    'name' => $comment->user->name,
                    'image' => $comment->user->image,
                ],
            ];
        }),
        ];

        return response()->json([
            'post' => $postData,
            'status' => 'success'
        ]);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ]);
        $post = auth()->user()->posts()->create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'category_id' => $validated['category_id'],
        ]);

        if (!empty($validated['tags'])) {
            $post->tags()->attach($validated['tags']);
        }

        return response()->json($post->load('category','tags','user'));
    }

    public function update(Request $request, Post $post) {
        $validated = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'array|exists:tags,id',
        ]);

        $this->authorize('update', $post);

        $updatedPost = $post->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'category_id' => $validated['category_id'],
        ]);

        if ($request->has('tags')) {
            $post->tags()->sync($validated['tags']);
        }

        return response()->json(($updatedPost));
    }

    public function destroy(Post $post) {
        $this->authorize('delete', $post);
        if(empty($post)){
            return response()->json([
                'status' => 'error',
                'message' => 'Post not found'
            ]);
        }
        $post->delete();
        return response()->json(['message' => 'Post deleted successfully']);
    }
}
