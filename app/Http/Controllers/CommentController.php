<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'post_id' => 'required|integer|exists:posts,id',
            'body' => 'required|string|max:2000',
        ]);

        $post = Post::findOrFail($validated['post_id']);
        $post->comments()->create([
            'body' => $validated['body'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->back();
    }
}
