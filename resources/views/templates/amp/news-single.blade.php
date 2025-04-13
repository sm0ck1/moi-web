@extends('templates.amp-layout')

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
    "logo": {
      "@type": "ImageObject",
      "url": "{{ asset('publisher-logo.png') }}"
    }
  },
  "description": "{{ $post->description }}"
}
    </script>
@endpush
@section('content')
    <div class="card-grid">
        <div>
            <article class="card">
                <amp-img src="{{ $post->image }}&w=800&h=400&c=1&o=1"
                         width="800"
                         height="400"
                         layout="responsive"
                         alt="{{ $post->title }}">
                </amp-img>

                <div class="card-content">
                    <div class="article-meta">
                        <div>
                            <span>Published by </span>
                            <span>{{ $post->author ?? 'Admin' }}</span>
                        </div>
                        <time datetime="{{ $post->created_at->toIso8601String() }}">
                            {{ $post->created_at->format('F d, Y') }}
                        </time>
                    </div>

                    <h1 class="article-title">{{ $post->title }}</h1>

                    <!-- AMP-совместимый рекламный блок - лучше размещение для мобильных -->
                    <div class="ad-container">
                        <amp-ad width="300"
                                height="250"
                                layout="responsive"
                                type="adsense"
                                data-ad-client="ca-pub-5063920583143502"
                                data-ad-slot="4646589929">
                        </amp-ad>
                    </div>

                    <div class="article-content">
                        @php
                            $ampContent = preg_replace(
                                [
                                    '/<img([^>]+)>/i',
                                    '/<iframe([^>]+)>/i',
                                    '/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/i',
                                    '/<table([^>]*)>/i',  // Делаем таблицы адаптивными
                                    '/<blockquote([^>]*)>/i'  // Стилизуем цитаты
                                ],
                                [
                                    '<amp-img$1 layout="responsive" width="800" height="400"></amp-img>',
                                    '<amp-iframe$1 layout="responsive" sandbox="allow-scripts allow-same-origin" width="800" height="400"></amp-iframe>',
                                    '',
                                    '<div class="table-responsive"><table$1>',
                                    '<blockquote$1 class="mobile-quote">'
                                ],
                                $post->text
                            );

                            $ampContent = str_replace('</table>', '</table></div>', $ampContent);
                        @endphp

                        {!! $ampContent !!}
                    </div>

                    <div class="article-tags">
                        <h4 class="article-tags-title">Tags</h4>
                        <div>
                            @foreach($post->tags as $tag)
                                <span class="tag">{{ $tag }}</span>
                            @endforeach
                        </div>
                    </div>

                    <div class="amp-social-share-container">
                        <amp-social-share type="twitter" width="40" height="40"></amp-social-share>
                        <amp-social-share type="facebook" width="40" height="40"></amp-social-share>
                        <amp-social-share type="linkedin" width="40" height="40"></amp-social-share>
                        <amp-social-share type="email" width="40" height="40"></amp-social-share>
                    </div>
                </div>
            </article>
        </div>

        <div>
            <div class="sidebar">
                <div class="card">
                    <div class="card-content">
                        <h3 class="sidebar-title">Related News</h3>
                        @foreach($relatedPosts as $relatedPost)
                            <div class="related-post">
                                <a href="{{ route('posts.amp.show', [$relatedPost->slug, $relatedPost->id]) }}" class="related-post-title">
                                    {{ $relatedPost->title }}
                                </a>
                                <p class="related-post-description">
                                    {{ Str::limit($relatedPost->description, 80) }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="card" style="margin-top: 20px">
                    <div class="card-content">
                        <div class="ad-container">
                            <amp-ad width="300"
                                    height="250"
                                    type="adsense"
                                    data-ad-client="ca-pub-5063920583143502"
                                    data-ad-slot="3892745601">
                            </amp-ad>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="application/ld+json">
        {
            "@context": "http://schema.org",
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
            "dateModified": "{{ $post->updated_at->toIso8601String() }}",
            "author": {
                "@type": "Person",
                "name": "{{ $post->author ?? 'Admin' }}"
            },
            "publisher": {
                "@type": "Organization",
                "name": "{{ $_SERVER['HTTP_HOST'] }}",
                "logo": {
                    "@type": "ImageObject",
                    "url": "https://{{ $_SERVER['HTTP_HOST'] }}/images/logo.png",
                    "width": 600,
                    "height": 60
                }
            },
            "description": "{{ $post->description }}"
        }
    </script>
@endsection
