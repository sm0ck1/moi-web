<rss version="2.0" xmlns:media="http://search.yahoo.com/mrss/">
    <channel>
        <title>{{ $_SERVER['HTTP_HOST'] }}</title>
        <link>{{ url('/') }}</link>
        <description>Last news</description>
        @foreach($posts as $post)
            <item>
                <title>{{ htmlspecialchars($post->title) }}</title>
                <link>{{ route('posts.show', [$post->slug, $post->id]) }}</link>
                <pubDate>{{ $post->updated_at->format('r') }}</pubDate>
                <description>{{ htmlspecialchars($post->description) }}</description>
                <media:content url="{{ $post->image }}" medium="image" />
            </item>
        @endforeach
    </channel>
</rss>
