@extends('templates.layout')

@section('title', $post->title)
@section('meta_description', $post->description)
@section('og_title', $post->title)
@section('og_description', $post->description)
@section('og_image', $post->image)
@section('twitter_title', $post->title)
@section('twitter_description', $post->description)
@section('twitter_image', $post->image)
@section('canonical_url', route('posts.show', [$post->slug, $post->id]))
@push('head')
    <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "NewsArticle",
          "mainEntityOfPage": {
            "@type": "WebPage",
            "@id": "{{ route('posts.show', [$post->slug, $post->id]) }}"
  },
  "headline": "{{ $post->title }}",
  "image": [
    "{{ $post->image }}"
  ],
  "datePublished": "{{ $post->created_at->toIso8601String() }}",
  "dateModified": "{{ $post->updated_at->toIso8601String() ?? $post->created_at->toIso8601String() }}",
  "author": {
    "@type": "Person",
    "name": "{{ $post->author ?? 'Admin' }}"
  },
  "publisher": {
    "@type": "Organization",
    "name": "{{ $_SERVER['HTTP_HOST'] }}",
    "url": "{{ asset('publisher-logo.png') }}"
  },
  "description": "{{ $post->description }}"
}
    </script>
@endpush
@push('styles')
    <style>
        /* Enhanced Typography and Content Styles */
        .prose {
            max-width: none;
            line-height: 1.7;
        }

        .prose h1 {
            font-size: 2.25rem;
            color: #1a202c;
            margin-bottom: 1.5rem;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 0.5rem;
        }

        .prose h2 {
            font-size: 1.75rem;
            color: #2d3748;
            margin-top: 1.5rem;
            margin-bottom: 1rem;
            border-bottom: 1px solid #edf2f7;
            padding-bottom: 0.5rem;
        }

        .prose h3 {
            font-size: 1.5rem;
            color: #4a5568;
            margin-top: 1.25rem;
            margin-bottom: 0.75rem;
        }

        .prose p {
            margin-bottom: 1rem;
            color: #4a5568;
        }

        .prose blockquote {
            border-left: 4px solid #cbd5e0;
            padding-left: 1rem;
            font-style: italic;
            color: #718096;
            margin: 1.5rem 0;
        }

        .prose ul, .prose ol {
            margin-bottom: 1rem;
            padding-left: 1.5rem;
        }

        .prose a {
            color: #3182ce;
            text-decoration: underline;
            transition: color 0.3s ease;
        }

        .prose a:hover {
            color: #2c5282;
        }

        .prose img {
            max-width: 100%;
            height: auto;
            border-radius: 0.5rem;
            margin: 1rem 0;
        }

        .prose code {
            background-color: #f7fafc;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.9rem;
        }

        .prose pre {
            background-color: #f7fafc;
            padding: 1rem;
            border-radius: 0.5rem;
            overflow-x: auto;
            margin: 1rem 0;
        }
    </style>
@endpush

@section('content')
    <div class="flex flex-col md:flex-row gap-6">
        <div class="w-full md:w-2/3">
            <article class="bg-white rounded-lg shadow-md overflow-hidden">

                <div class="flex flex-col md:flex-row gap-6">
                    <img src="{{$post->image}}&w=200&h=200&c=1&o=1" alt="{{ $post->title }}"
                         class="w-full">
                    <div class="w-full">
                        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5063920583143502"
                                crossorigin="anonymous"></script>
                        <!-- top in news -->
                        <ins class="adsbygoogle"
                             style="display:block"
                             data-ad-client="ca-pub-5063920583143502"
                             data-ad-slot="4646589929"
                             data-ad-format="auto"
                             data-full-width-responsive="true"></ins>
                        <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                    </div>
                </div>

                <div class="p-6">
                    <div class="text-gray-600 mb-4 flex justify-between items-center">
                        <div>
                            <span class="mr-2">Published by</span>
                            <span class="font-semibold">{{ $post->author ?? 'Admin' }}</span>
                        </div>
                        <time datetime="{{ $post->created_at }}" class="text-sm">
                            {{ $post->created_at->format('F d, Y') }}
                        </time>
                    </div>

                    <div class="prose max-w-none">
                        {!! $post->text !!}
                    </div>

                    <div class="mt-6">
                        <h4 class="text-lg font-semibold mb-3">Tags</h4>
                        <div class="flex flex-wrap gap-2">
                            @foreach($post->tags as $tag)
                                <a href="#"
                                   {{--                                <a href="{{ route('tags.show', $tag->slug) }}"--}}
                                   class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm hover:bg-blue-200 transition">
                                    {{ $tag }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </article>
        </div>

        <div class="w-full md:w-1/3">
            <div class="space-y-6 sticky top-4">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-bold mb-4">Related News</h3>
                    @foreach($relatedPosts as $relatedPost)
                        <div class="mb-4 pb-4 border-b last:border-b-0">
                            <a href="{{ route('posts.show', [$relatedPost->slug, $relatedPost->id]) }}"
                               class="text-blue-500 hover:underline">
                                <h4 class="text-base font-semibold">{{ $relatedPost->title }}</h4>
                            </a>
                            <p class="text-sm text-gray-600 mt-1">
                                {{ Str::limit($relatedPost->description, 100) }}
                            </p>
                        </div>
                    @endforeach
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="h-96 bg-gray-200 flex items-center justify-center text-gray-500">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
