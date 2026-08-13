<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
   
    public function index(Request $request)
    {
        $query = Post::query();

        if ($request->filled('tag')) {
            $query->where('type_body', $request->tag);
        }

        $posts = $query->latest()->paginate(10);

        $totalPosts = Post::count();
        $totalTopics = Post::distinct('type_body')->count('type_body');
        $startYear = Post::oldest()->value('created_at')?->format('Y') ?? date('Y');
        $topics = Post::select('type_body')->distinct()->pluck('type_body');

        return view('posts.index', compact('posts', 'totalPosts', 'totalTopics', 'startYear', 'topics'));
    }


    public function create()
    {
        return view('posts.create');
    }

    public function store(StorePostRequest $request)
    {
        if ($request->hasFile('image')) {
            $name = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('post-images', $name, 'public');
        }


        $posts = Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'type_body' => $request->type_body,
            'short_body' => $request->short_body,
            'body' => $request->body,
            'image' => $path ?? null,
        ]);

        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
        return view('posts.show')->with(['post' => $post]);
    }

    public function edit(Post $post)
    {
        Gate::authorize('update', $post);

        return view('posts.edit')->with(['post' => $post]);
    }

    public function update(StorePostRequest $request, Post $post)
    {
        Gate::authorize('update', $post);

        if ($request->hasFile('image')) {

            if (isset($post->image)) {
                Storage::disk('public')->delete($post->image);
            }

            $name = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('post-images', $name, 'public');
        }


        $post->update([
            'title' => $request->title,
            'type_body' => $request->type_body,
            'short_body' => $request->short_body,
            'body' => $request->body,
            'image' => $path ?? $post->image,
        ]);

        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);
        
        if(isset($post->image)){
            Storage::disk('public')->delete($post->image);
        }
         
        $post->delete();

        return redirect()->route('posts.index');
    }
}
