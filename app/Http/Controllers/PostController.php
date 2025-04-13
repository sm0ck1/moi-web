<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request)
    {

        $posts = Post::query()->latest()->paginate(20);
        if ($posts->isEmpty()) {
            abort(404);
        }
        $isAmp = last($request->segments()) == 'amp';

        return view($isAmp ? 'templates.amp.news-list' : 'templates.base.news-list', compact('posts'));
    }

    public function show($slug, Post $post, Request $request)
    {
        if ($post->slug != $slug) {
            abort(404);
        }
        $isAmp = last($request->segments()) == 'amp';

        $post->text = Str::markdown($post->text);
        // previous posts
        $relatedPosts = Post::query()->where('id', '<', $post->id)
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();

        return view($isAmp ? 'templates.amp.news-single' : 'templates.base.news-single', compact('post', 'relatedPosts'));
    }

    public function getAllPosts()
    {
        $post = Post::query()->latest()->withoutGlobalScopes()->with('domain')->get();
        $content = $post->map(function ($item) {
            return 'https://'.$item->domain->name.'/'.$item->slug.'/'.$item->id;
        })->implode("\n");

        return response($content, 200, [
            'Content-Type' => 'text/plain',
        ]);
    }
}
