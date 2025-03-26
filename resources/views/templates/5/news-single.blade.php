@extends('layouts.app')

@section('title', $news->title)
@section('meta_description', $news->excerpt)
@section('og_title', $news->title)
@section('og_description', $news->excerpt)
@section('og_image', $news->image)
@section('twitter_title', $news->title)
@section('twitter_description', $news->excerpt)
@section('twitter_image', $news->image)
@section('canonical_url', route('news.show', $news->slug))

@section('content')
    <article class="bg-white rounded-lg shadow-md overflow-hidden">
        <img src="{{ $news->image }}" alt="{{ $news->title }}" class="w-full h-64 object-cover">
        <div class="p-6">
            <h1 class="text-3xl font-bold mb-4">{{ $news->title }}</h1>
            <div class="text-gray-600 mb-4">
                <span>{{ $news->author }}</span> |
                <time datetime="{{ $news->published_at->toDateString() }}">{{ $news->published_at->format('d.m.Y') }}</time>
            </div>
            <div class="prose max-w-none">
                {!! $news->content !!}
            </div>
        </div>
    </article>
@endsection
