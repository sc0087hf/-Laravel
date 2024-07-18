<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Post;

class PostController extends Controller
{
    public function index() {
        // $posts = Post::all();
        $posts = Post::where('user_id', auth()->id())->get();
        return view('post.index', compact('posts'));
    }

    public function create() {
        return view('post.create');
    }

    public function store(Request $request) {
        Gate::authorize('test');

        $validated = $request->validate([
            'title' => 'required|max:20',
            'body' => 'required|max:400',
        ]);

        $validated['user_id'] = auth()->id();

        $post = Post::create($validated);

        $request->session()->flash('message', '投稿が完了しました');
        return back();
    }

    public function show(Post $post) {
        return view('post.show', compact('post'));
    }

    public function edit(Post $post) {
        return view('post.edit', compact('post'));
    }

    public function update(Request $request, Post $post) {
        $validated = $request->validate([
            'title' => 'required|max:20',
            'body' => 'required|max:400',
        ]);

        $validated['user_id'] = auth()->id();

        $post->update($validated);

        $request->session()->flash('message', '更新が完了しました');

        return back();
    }

    public function destroy(Request $request, Post $post) {
        $post->delete();

        $request->session()->flash('message', '削除が完了しました');

        return redirect()->route('post.index');
    }
}
