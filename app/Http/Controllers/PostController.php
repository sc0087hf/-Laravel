<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\PostRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //$posts = Post::where('user_id', auth()->id())->orderBy('created_at', 'desc')->paginate(5);
        $posts = Post::orderBy('created_at', 'desc')->paginate(5);
        
        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request): RedirectResponse
    {

        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = auth()->id();

        $post->save();

        return redirect(route('post.index'))->with('message', '投稿しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): View
    {
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post): View
    {
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post): RedirectResponse
    {
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = auth()->id();

        $post->update();

        return redirect(route('post.show', compact('post')))->with('message', '投稿を更新しました。');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Post $post): RedirectResponse
    {
        $post->delete();

        return redirect(route('post.index'))->with('message', '投稿を削除しました');
    }
}
