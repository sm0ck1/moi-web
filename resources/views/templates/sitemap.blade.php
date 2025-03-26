<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml"
        xmlns:news="http://www.google.com/schemas/sitemap-news/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
        xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">

    <!-- Main Pages -->
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ now()->format('Y-m-d\TH:i:sP') }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    <url>
        <loc>{{ route('page.show', 'about') }}</loc>
        <lastmod>{{ now()->format('Y-m-d\TH:i:sP') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>

    <url>
        <loc>{{ route('page.show', 'contact') }}</loc>
        <lastmod>{{ now()->format('Y-m-d\TH:i:sP') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
    </url>

    <!-- News Posts -->
    @foreach($posts as $post)
        <url>
            <loc>{{ route('posts.show', [$post->slug, $post->id]) }}</loc>
            <lastmod>{{ $post->updated_at->format('Y-m-d\TH:i:sP') }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>

            <!-- News-specific tags -->
            <news:news>
                <news:publication>
                    <news:name>{{ $_SERVER['HTTP_HOST'] }}</news:name>
                    <news:language>{{ app()->getLocale() }}</news:language>
                </news:publication>
                <news:publication_date>{{ $post->created_at->format('Y-m-d\TH:i:sP') }}</news:publication_date>
                <news:title>{{ htmlspecialchars($post->title) }}</news:title>
            </news:news>

            <!-- Image for each post -->
            <image:image>
                <image:loc>{{ $post->image }}</image:loc>
                <image:caption>{{ htmlspecialchars($post->title) }}</image:caption>
                <image:title>{{ htmlspecialchars($post->title) }}</image:title>
            </image:image>
        </url>
    @endforeach

    <!-- Additional Static Pages -->
    <url>
        <loc>{{ route('page.show', 'privacy') }}</loc>
        <lastmod>{{ now()->format('Y-m-d\TH:i:sP') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
    </url>

    <url>
        <loc>{{ route('page.show', 'terms') }}</loc>
        <lastmod>{{ now()->format('Y-m-d\TH:i:sP') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
    </url>
</urlset>
