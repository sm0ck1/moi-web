@extends('templates.layout')

@section('title', $posts[0]->title)
@section('meta_description', $posts[0]->description)

@section('content')
    <div class="flex flex-col md:flex-row gap-6">
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
            </div>
        </div>

        <div class="w-full md:w-1/3">
            <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                <div class="h-96 bg-gray-200 flex items-center justify-center text-gray-500">

                </div>
            </div>
        </div>
    </div>
@endsection
