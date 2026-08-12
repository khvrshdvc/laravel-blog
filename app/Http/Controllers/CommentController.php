<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Dom\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {

        $post = Post::find($request->post_id);
        $post->comments()->create([
            'body' => $request->body,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back();
    }
}
