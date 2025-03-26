<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Новостной сайт'))</title>
    <meta name="description" content="@yield('meta_description', 'Ваше описание по умолчанию')">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('og_title', config('app.name', 'Новостной сайт'))">
    <meta property="og:description" content="@yield('og_description', 'Ваше описание по умолчанию')">
    <meta property="og:image" content="@yield('og_image', asset('path/to/default-image.jpg'))">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('twitter_title', config('app.name', 'Новостной сайт'))">
    <meta property="twitter:description" content="@yield('twitter_description', 'Ваше описание по умолчанию')">
    <meta property="twitter:image" content="@yield('twitter_image', asset('path/to/default-image.jpg'))">

    <!-- Canonical URL -->
    <link rel="canonical" href="@yield('canonical_url', url()->current())">

    <script src="https://cdn.tailwindcss.com"></script>

    @stack('styles')

</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
<header>
    @include('templates.base.header')
</header>

<main class="container mx-auto mt-4 px-4">
    @yield('content')
</main>

<footer>
    @include('templates.base.footer')
</footer>

</body>
</html>
