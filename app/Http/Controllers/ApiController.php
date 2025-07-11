<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\SetDomainRequest;
use App\Http\Requests\Api\SetPostRequest;
use App\Http\Requests\CreateDirtyPostRequest;
use App\Models\DirtyPost;
use App\Models\Domain;
use App\Models\Post;
use App\Models\Topic;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ApiController extends Controller
{

    public function setDirtyPost(CreateDirtyPostRequest $request): \Illuminate\Http\JsonResponse
    {

        $dirty_post = DirtyPost::query()->create($request->validated());

        return response()->json([
            $dirty_post,
        ]);

    }

    public function setDomain(SetDomainRequest $request)
    {
        $topic = Topic::query()->where('name', $request->get('topic_name'))->first();
        if (! $topic) {
            $topic = Topic::query()->create([
                'name' => $request->get('topic_name'),
            ]);
            // create folder
            $path = resource_path("views/templates/{$topic->id}");

            File::makeDirectory($path, 0755, true, true);
        }

        $checkDomain = Domain::where('name', $request->get('name'))->first();
        if (! $checkDomain) {
            $checkDomain = Domain::query()->create([
                'name' => $request->get('name'),
                'topic_id' => $topic->id,
            ]);
        }

        return response()->json([
            'topic' => $topic,
            'domain' => $checkDomain,
        ]);
    }

    public function getDomains($topic): \Illuminate\Http\JsonResponse
    {

        $domain = Domain::query()->where('topic_id', $topic->id)->get();

        return response()->json([
            'domain' => $domain->random(),
        ]);

    }

    public function getTopics(): \Illuminate\Http\JsonResponse
    {
        $topics = Topic::all();

        return response()->json($topics);

    }

    public function setPosts(SetPostRequest $request): \Illuminate\Http\JsonResponse
    {
        $topic = Topic::query()->where('name', $request->get('topic_name'))->first();
        if (! $topic) {
            $topic = Topic::query()->create([
                'name' => $request->get('topic_name'),
            ]);
            // create folder
            $path = resource_path("views/templates/{$topic->id}");

            File::makeDirectory($path, 0755, true, true);
        }

        $checkDomain = Domain::query()->get();
        if (! $checkDomain) {
            $checkDomain[] = Domain::query()->create([
                'name' => $_SERVER['HTTP_HOST'],
                'topic_id' => $topic->id,
            ]);
        }

        $domain = collect($checkDomain)->random();

        $post = Post::query()->create([
            'domain_id' => $domain->id,
            'text' => $request->get('text'),
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'tags' => explode(',', $request->get('tags')),
        ]);

        return response()->json([
            'post' => $post,
            'link' => 'https://'.$domain->name.'/'.Str::slug($post->title).'/'.$post->id,
        ]);

    }
}
