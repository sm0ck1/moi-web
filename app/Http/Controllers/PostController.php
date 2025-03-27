<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::query()->paginate(20);
        if($posts->isEmpty()){
            abort(404);
        }
        return view('templates.base.news-list', compact('posts'));
    }

    public function show($slug, Post $post)
    {
        if ($post->slug != $slug) {
            abort(404);
        }
        $post->text = Str::markdown($post->text);
        //previous posts
        $relatedPosts = Post::query()->where('id', '<', $post->id)
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();
        return view('templates.base.news-single', compact('post', 'relatedPosts'));
    }

    public function getAllPosts()
    {
        $post = Post::query()->get();
        $content = $post->map(function ($item) {
            return 'https://' . $_SERVER['HTTP_HOST'] . '/' . $item->slug . '/' . $item->id;
        })->implode("\n");
        return response($content, 200, [
            'Content-Type' => 'text/plain'
        ]);
    }
}
