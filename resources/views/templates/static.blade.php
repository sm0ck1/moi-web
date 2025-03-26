@extends('templates.layout')

@section('title', $page['title'])
@section('meta_description', $page['description'])

@push('styles')
    <style>
        .static-page h1 {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            color: #2c3e50;
            border-bottom: 2px solid #ecf0f1;
            padding-bottom: 0.5rem;
        }

        .static-page h2 {
            font-size: 1.8rem;
            margin-top: 1.5rem;
            margin-bottom: 1rem;
            color: #34495e;
        }

        .static-page h3 {
            font-size: 1.4rem;
            color: #2980b9;
            margin-top: 1.2rem;
        }

        .static-page p {
            margin-bottom: 1rem;
            line-height: 1.6;
            color: #555;
        }

        .static-page ul, .static-page ol {
            margin-left: 1.5rem;
            margin-bottom: 1rem;
        }

        .static-page a {
            color: #3498db;
            text-decoration: underline;
            transition: color 0.3s ease;
        }

        .static-page a:hover {
            color: #2980b9;
        }
    </style>
@endpush

@section('content')
    <div class="container mx-auto px-4 py-8">
        <article class="static-page max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
            {!! $content !!}
        </article>
    </div>
@endsection
