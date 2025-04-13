<!doctype html>
<html ⚡ lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <title>@yield('title', config('app.name', 'Новостной сайт'))</title>
    <meta name="description" content="@yield('meta_description', 'Ваше описание по умолчанию')">

    <!-- Канонический URL -->
    <link rel="canonical" href="@yield('canonical_url', url()->current())">

    <!-- Обязательный тег для AMP -->
    <script async src="https://cdn.ampproject.org/v0.js"></script>

    <!-- Обязательные стили AMP -->
    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>

    <!-- Подключение компонентов AMP -->
    <script async custom-element="amp-social-share" src="https://cdn.ampproject.org/v0/amp-social-share-0.1.js"></script>
    <script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
    <script async custom-element="amp-ad" src="https://cdn.ampproject.org/v0/amp-ad-0.1.js"></script>
    <!-- Добавляем поддержку AMP sidebar для мобильной навигации -->
    <script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('og_title', config('app.name', 'Новостной сайт'))">
    <meta property="og:description" content="@yield('og_description', 'Ваше описание по умолчанию')">
    <meta property="og:image" content="@yield('og_image')">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('twitter_title', config('app.name', 'Новостной сайт'))">
    <meta property="twitter:description" content="@yield('twitter_description', 'Ваше описание по умолчанию')">
    <meta property="twitter:image" content="@yield('twitter_image')">

    <!-- AMP пользовательские стили (должны быть встроены и ограничены 50KB) -->
    <style amp-custom>
        /* Базовые стили */
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f7f8f9;
            margin: 0;
            -webkit-text-size-adjust: 100%;
            -webkit-font-smoothing: antialiased;
        }

        /* Контейнер */
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 0.75rem;
            box-sizing: border-box;
        }

        /* Шапка */
        .header {
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 10;
            padding: 0.75rem 0;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-brand {
            font-size: 1.25rem;
            font-weight: bold;
            color: #1a202c;
            text-decoration: none;
        }

        /* Mobile menu button */
        .menu-toggle {
            display: block;
            background: none;
            border: none;
            padding: 0.5rem;
            cursor: pointer;
            font-size: 1.5rem;
            color: #4a5568;
        }

        /* Hide desktop nav on mobile */
        .header-nav {
            display: none;
        }

        /* Sidebar navigation */
        amp-sidebar {
            width: 250px;
            background-color: #fff;
            padding: 1.5rem;
        }

        .sidebar-nav a {
            display: block;
            margin-bottom: 1rem;
            color: #4a5568;
            text-decoration: none;
            font-size: 1rem;
            padding: 0.5rem 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .sidebar-nav a:hover {
            color: #1a202c;
        }

        .sidebar-close {
            margin-bottom: 1.5rem;
            text-align: right;
        }

        /* Основное содержимое */
        .main-content {
            margin: 1rem 0;
        }

        /* Карточки новостей */
        .card {
            background-color: #fff;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            overflow: hidden;
            margin-bottom: 1rem;
        }

        .card-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        /* Responsive grid */
        @media (min-width: 768px) {
            .card-grid {
                grid-template-columns: 2fr 1fr;
                gap: 1.5rem;
            }

            .container {
                padding: 0 1rem;
            }

            .header-brand {
                font-size: 1.5rem;
            }

            .menu-toggle {
                display: none;
            }

            .header-nav {
                display: block;
            }

            .header-nav a {
                margin-left: 1rem;
                color: #4a5568;
                text-decoration: none;
            }

            .header-nav a:hover {
                color: #1a202c;
            }

            .card {
                margin-bottom: 1.5rem;
            }
        }

        .card-content {
            padding: 0.75rem;
        }

        @media (min-width: 768px) {
            .card-content {
                padding: 1rem;
            }
        }

        .card-title {
            font-size: 1.125rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: #2d3748;
            line-height: 1.3;
        }

        @media (min-width: 768px) {
            .card-title {
                font-size: 1.25rem;
            }
        }

        .card-title a {
            color: #3182ce;
            text-decoration: none;
        }

        .card-title a:hover {
            text-decoration: underline;
        }

        .card-description {
            font-size: 0.9375rem;
            color: #4a5568;
            margin-bottom: 1rem;
        }

        .card-meta {
            font-size: 0.8125rem;
            color: #718096;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Стили для статьи */
        .article-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
            color: #1a202c;
            line-height: 1.3;
        }

        @media (min-width: 768px) {
            .article-title {
                font-size: 1.75rem;
            }
        }

        .article-meta {
            font-size: 0.8125rem;
            color: #718096;
            margin-bottom: 1rem;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .article-content {
            margin-bottom: 2rem;
            line-height: 1.7;
            font-size: 1rem;
        }

        .article-content p {
            margin-bottom: 1rem;
        }

        .article-content h2 {
            font-size: 1.375rem;
            color: #2d3748;
            margin: 1.5rem 0 1rem;
            line-height: 1.3;
        }

        .article-content h3 {
            font-size: 1.25rem;
            color: #4a5568;
            margin: 1.25rem 0 0.75rem;
            line-height: 1.3;
        }

        .article-content a {
            color: #3182ce;
            text-decoration: underline;
        }

        .article-tags {
            margin-top: 1.5rem;
        }

        .article-tags-title {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
        }

        .tag {
            display: inline-block;
            background-color: #ebf4ff;
            color: #3182ce;
            font-size: 0.8125rem;
            padding: 0.375rem 0.75rem;
            border-radius: 9999px;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
        }

        /* Improve touch targets for mobile */
        .tag, .card-meta a, .pagination-item-link {
            min-height: 44px;
            min-width: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        /* Боковая панель */
        .sidebar {
            margin-bottom: 1.5rem;
        }

        .sidebar-title {
            font-size: 1.125rem;
            font-weight: bold;
            margin-bottom: 1rem;
            color: #2d3748;
        }

        @media (min-width: 768px) {
            .sidebar-title {
                font-size: 1.25rem;
            }
        }

        .related-post {
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e2e8f0;
        }

        .related-post:last-child {
            border-bottom: none;
        }

        .related-post-title {
            font-size: 0.9375rem;
            font-weight: 600;
            color: #3182ce;
            text-decoration: none;
            margin-bottom: 0.25rem;
            display: block;
            line-height: 1.3;
        }

        .related-post-title:hover {
            text-decoration: underline;
        }

        .related-post-description {
            font-size: 0.8125rem;
            color: #4a5568;
        }

        /* Пагинация */
        .pagination {
            display: flex;
            justify-content: center;
            margin: 2rem 0;
            flex-wrap: wrap;
        }

        .pagination-item {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin: 0.25rem;
        }

        .pagination-item-link {
            padding: 0.5rem 0.75rem;
            color: #3182ce;
            background-color: #ebf4ff;
            border-radius: 0.25rem;
            text-decoration: none;
            font-size: 0.9375rem;
        }

        .pagination-item-current {
            padding: 0.5rem 0.75rem;
            color: #fff;
            background-color: #3182ce;
            border-radius: 0.25rem;
            font-size: 0.9375rem;
        }

        .pagination-item-disabled {
            padding: 0.5rem 0.75rem;
            color: #a0aec0;
            background-color: #e2e8f0;
            border-radius: 0.25rem;
            cursor: not-allowed;
            font-size: 0.9375rem;
        }

        /* Social share buttons - better touch targets */
        .amp-social-share-container {
            display: flex;
            gap: 0.5rem;
            margin-top: 1.5rem;
        }

        amp-social-share {
            margin-right: 0.5rem;
            border-radius: 4px;
        }

        /* Ad containers */
        .ad-container {
            margin: 1.5rem 0;
            text-align: center;
        }

        /* Подвал */
        .footer {
            background-color: #2d3748;
            color: #e2e8f0;
            padding: 1.5rem 0;
            margin-top: 2rem;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        @media (min-width: 768px) {
            .footer {
                padding: 2rem 0;
            }

            .footer-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 2rem;
            }
        }

        .footer-title {
            font-size: 1.125rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .footer-text {
            color: #a0aec0;
            margin-bottom: 1rem;
            font-size: 0.9375rem;
        }

        .footer-links a {
            display: block;
            color: #a0aec0;
            margin-bottom: 0.5rem;
            text-decoration: none;
            font-size: 0.9375rem;
            padding: 0.5rem 0;
        }

        .footer-links a:hover {
            color: #fff;
        }

        .footer-bottom {
            border-top: 1px solid #4a5568;
            margin-top: 1.5rem;
            padding-top: 1rem;
            text-align: center;
            color: #a0aec0;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
<header class="header">
    <div class="container header-content">
        <a href="/amp" class="header-brand">{{ $_SERVER['HTTP_HOST'] }}</a>

        <!-- Mobile menu button -->
        <button class="menu-toggle" on="tap:sidebar.toggle">☰</button>

        <!-- Desktop navigation -->
        <nav class="header-nav">
            <a href="/amp">Home</a>
            <a href="/about/amp">About</a>
            <a href="/contact/amp">Contact</a>
        </nav>
    </div>
</header>

<!-- Mobile sidebar menu -->
<amp-sidebar id="sidebar" layout="nodisplay" side="right">
    <div class="sidebar-close">
        <button on="tap:sidebar.close">✕</button>
    </div>
    <nav class="sidebar-nav">
        <a href="/amp">Home</a>
        <a href="/about/amp">About us</a>
        <a href="/privacy/amp">Privacy Policy</a>
        <a href="/terms/amp">Terms of Use</a>
        <a href="/contact/amp">Contacts</a>
    </nav>
</amp-sidebar>

<main class="main-content container">
    @yield('content')
</main>

<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div>
                <h3 class="footer-title">About Us</h3>
                <p class="footer-text">
                    A news portal with the most current and interesting news from around the world.
                </p>
            </div>
            <div>
                <h3 class="footer-title">Useful Links</h3>
                <div class="footer-links">
                    <a href="/about/amp">About us</a>
                    <a href="/privacy/amp">Privacy Policy</a>
                    <a href="/terms/amp">Terms of Use</a>
                    <a href="/contact/amp">Contacts</a>
                </div>
            </div>
            <div>
                <h3 class="footer-title">Subscribe</h3>
                <p class="footer-text">
                    Subscribe to our newsletter to receive the latest news.
                </p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} {{ $_SERVER['HTTP_HOST'] }}. All rights reserved.</p>
        </div>
    </div>
</footer>

<!-- Google Analytics -->
<amp-analytics type="googleanalytics">
    <script type="application/json">
        {
            "vars": {
                "account": "G-7P7XJLBB7H"
            },
            "triggers": {
                "trackPageview": {
                    "on": "visible",
                    "request": "pageview"
                }
            }
        }
    </script>
</amp-analytics>
</body>
</html>
