<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class CommentController extends Controller
{
    use AuthorizesRequests;
    function store(Request $request, Post $post){
        $data = $request->validate([
            'content' => 'required|string',
        ]);

        $comment = $post->comments()->create([
            'content' => $data['content'],
            'user_id' => Auth::id(),
        ]);

        return response()->json([
            'status' => 'success',
            'comment' => $comment
        ]);
    }

    function update(Request $request, Comment $comment){
        $data = $request->validate([
            'content' => 'required|string',
        ]);

        $this->authorize('update', $comment);
        $comment->update([
            'content' => $data['content'],
        ]);

        return response()->json([
            'status' => 'success',
            'comment' => $comment
        ]);
    }

    function destroy(Comment $comment){
        $this->authorize('delete', $comment);
        if(empty($comment)){
            return response()->json([
                'status' => 'error',
                'message' => 'Comment not found'
            ]);
        }
        $comment->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Comment deleted successfully'
        ]);
    }
}

