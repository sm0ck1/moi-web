@extends('templates.layout')

@section('title', $posts[0]->title)
@section('meta_description', $posts[0]->description)
@section('og_title', $posts[0]->title)
@section('og_description', $posts[0]->description)
@section('og_image', $posts[0]->image)
@section('twitter_title', $posts[0]->title)
@section('twitter_description', $posts[0]->description)
@section('twitter_image', $posts[0]->image)

@section('content')
    <div class="flex flex-col md:flex-row gap-6">
        <div class="w-full md:w-1/3">
            <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5063920583143502"
                        crossorigin="anonymous"></script>
                <!-- sidebar news -->
                <ins class="adsbygoogle"
                     style="display:block"
                     data-ad-client="ca-pub-5063920583143502"
                     data-ad-slot="3892745601"
                     data-ad-format="auto"
                     data-full-width-responsive="true"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
        </div>
        <div class="w-full md:w-2/3">
            <div class="flex flex-col gap-6">
                @foreach($posts as $item)
                    <article class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col md:flex-row">
                        <img src="{{ $item->image }}&w=200&h=200&c=1&o=1" alt="{{ $item->title }}" class="md:h-48">
                        <div class="p-4">
                            <a href="{{ route('posts.show', [$item->slug, $item->id]) }}" class="text-blue-500 hover:underline">
                                <h2 class="text-xl font-bold mb-2">{{ $item->title }}</h2>
                            </a>
                            <p class="text-gray-600 mb-4">{{ $item->description }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">{{ $item->created_at->format('M d, Y') }}</span>
                                <a href="{{ route('posts.show', [$item->slug, $item->id]) }}" class="text-blue-500 hover:underline">
                                    Read More
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
                    <div class="pagination flex justify-center items-center space-x-2 my-4">
                        {{ $posts->links('templates.base.pagination') }}
                    </div>
            </div>
        </div>


    </div>
@endsection
