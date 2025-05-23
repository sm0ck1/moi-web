<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    public function generate()
    {
        return Cache::remember('sitemap', now()->addHours(1), function () {

            $posts = Post::query()
                ->orderBy('created_at', 'desc')
                ->limit(1000) // Limit to prevent extremely large sitemaps
                ->get();

            $content = view('templates.sitemap', compact('posts'))
                ->render();

            return response($content, 200, [
                'Content-Type' => 'application/xml',
            ]);
        });
    }

    public function generateRss()
    {

        $posts = Post::query()
            ->orderBy('created_at', 'desc')
            ->limit(20) // Limit to prevent extremely large sitemaps
            ->get();

        $content = view('templates.rss', compact('posts'))
            ->render();

        return response($content, 200, [
            'Content-Type' => 'application/rss+xml; charset=UTF-8',
        ]);
    }

    public function robots()
    {

        $sitemapUrl = url('sitemap.xml');

        $disallowPaths = [
            'Disallow: /*?*',
        ];

        // Generate robots.txt content
        $content = implode("\n", array_filter([
            'User-agent: *',
            ...$disallowPaths,
            'Allow: /',
            "Sitemap: {$sitemapUrl}",

        ]));

        // Return as plain text response
        return response($content, 200, [
            'Content-Type' => 'text/plain',
        ]);
    }
}
