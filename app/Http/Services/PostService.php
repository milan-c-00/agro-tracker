<?php

namespace App\Http\Services;

use App\Models\Post;
use Illuminate\Http\Request;

class PostService
{

    public function index() {
        return Post::query()->get();
    }

    public function post_widget() {
        return Post::query()->orderBy('id', 'desc')->take(3)->get();
    }

    public function show(Post $post){
        return Post::query()->where('id', $post->id);
    }

    public function store(Request $request) {
        return Post::query()->create([
            'title' => $request->title,
            'content' => $request->post_content
        ]);
    }

    public function update(Post $post, Request $request){
        return $post->update([
            'title' => $request->title,
            'content' => $request->post_content
        ]);
    }

    public function destroy(Post $post){
        return $post->delete();
    }

}
