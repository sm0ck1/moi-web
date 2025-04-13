@extends('templates.amp-layout')

@section('title', $page['title'])
@section('meta_description', $page['description'])
@section('og_title', $page['title'])
@section('og_description', $page['description'])
    @section('canonical_url', url()->current())

    @section('content')
        <div class="container">
            <article class="card">
                <div class="card-content">
                    <!-- Преобразование содержимого в AMP-совместимый формат с улучшениями для мобильных -->
                    @php
                        // Преобразование HTML-контента в AMP-совместимый
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
                            $content
                        );

                        // Закрываем div для адаптивных таблиц
                        $ampContent = str_replace('</table>', '</table></div>', $ampContent);

                        // Увеличиваем размеры шрифтов заголовков для лучшей читаемости на мобильных
                        $ampContent = preg_replace(
                            '/<h([1-6])([^>]*)>/i',
                            '<h$1$2 class="mobile-heading-$1">',
                            $ampContent
                        );

                        // Улучшаем отступы для списков на мобильных
                        $ampContent = str_replace(
                            ['<ul>', '<ol>'],
                            ['<ul class="mobile-list">', '<ol class="mobile-list">'],
                            $ampContent
                        );
                    @endphp

                    {!! $ampContent !!}
                </div>
            </article>

            <!-- Добавляем рекламный блок для мобильных устройств -->
            <div class="ad-container">
                <amp-ad width="300"
                        height="250"
                        layout="responsive"
                        type="adsense"
                        data-ad-client="ca-pub-5063920583143502"
                        data-ad-slot="3892745601">
                </amp-ad>
            </div>
        </div>

        <!-- Структурированные данные для статической страницы -->
        <script type="application/ld+json">
            {
                "@context": "http://schema.org",
                "@type": "WebPage",
                "name": "{{ $page['title'] }}",
            "description": "{{ $page['description'] }}",
            "publisher": {
                "@type": "Organization",
                "name": "{{ $_SERVER['HTTP_HOST'] }}"
            }
        }
        </script>
    @endsection
