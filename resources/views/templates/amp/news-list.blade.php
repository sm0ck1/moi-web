@extends('templates.amp-layout')

@section('title', $posts[0]->title)
@section('meta_description', $posts[0]->description)
@section('og_title', $posts[0]->title)
@section('og_description', $posts[0]->description)
@section('og_image', $posts[0]->image)
@section('twitter_title', $posts[0]->title)
@section('twitter_description', $posts[0]->description)
@section('twitter_image', $posts[0]->image)

@section('content')
    <div class="card-grid">
        <div>
            <div>
                @foreach($posts as $item)
                    <article class="card">
                        <amp-img src="{{ $item->image }}&w=800&h=400&c=1&o=1"
                                 width="800"
                                 height="400"
                                 layout="responsive"
                                 alt="{{ $item->title }}">
                        </amp-img>
                        <div class="card-content">
                            <h2 class="card-title">
                                <a href="{{ route('posts.amp.show', [$item->slug, $item->id]) }}">
                                    {{ $item->title }}
                                </a>
                            </h2>
                            <p class="card-description">{{ Str::limit($item->description, 120) }}</p>
                            <div class="card-meta">
                                <span>{{ $item->created_at->format('M d, Y') }}</span>
                                <a href="{{ route('posts.amp.show', [$item->slug, $item->id]) }}"
                                   class="read-more">
                                    Read More
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach

                <nav class="pagination" role="navigation" aria-label="Pagination Navigation">
                    @if ($posts->hasPages())
                        {{-- Previous Page Link --}}
                        @if ($posts->onFirstPage())
                            <span class="pagination-item pagination-item-disabled">
                                &laquo;
                            </span>
                        @else
                            <a href="{{ $posts->previousPageUrl() }}" class="pagination-item pagination-item-link">
                                &laquo;
                            </a>
                        @endif

                        @php
                            $currentPage = $posts->currentPage();
                            $lastPage = $posts->lastPage();
                            $startPage = max(1, $currentPage - 1);
                            $endPage = min($lastPage, $currentPage + 1);

                            if ($startPage > 1) {
                                $startPage = 1;
                                $endPage = min($lastPage, 3);
                            } elseif ($endPage < $lastPage) {
                                $startPage = max(1, $lastPage - 2);
                                $endPage = $lastPage;
                            }
                        @endphp

                        @for ($i = $startPage; $i <= $endPage; $i++)
                            @if ($i == $posts->currentPage())
                                <span class="pagination-item pagination-item-current">{{ $i }}</span>
                            @else
                                <a href="{{ $posts->url($i) }}" class="pagination-item pagination-item-link">
                                    {{ $i }}
                                </a>
                            @endif
                        @endfor

                        @if ($posts->hasMorePages())
                            <a href="{{ $posts->nextPageUrl() }}" class="pagination-item pagination-item-link">
                                &raquo;
                            </a>
                        @else
                            <span class="pagination-item pagination-item-disabled">
                                &raquo;
                            </span>
                        @endif
                    @endif
                </nav>
            </div>
        </div>

        <div>
            <div class="sidebar">
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
@endsection
