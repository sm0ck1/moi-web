@extends('templates.layout')

@section('title', 'Список новостей')
@section('meta_description', 'Последние новости и события')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($news as $item)
            <article class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="{{ $item->image }}" alt="{{ $item->title }}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-xl font-bold mb-2">{{ $item->title }}</h2>
                    <p class="text-gray-600 mb-4">{{ $item->excerpt }}</p>
                    <a href="{{ route('news.show', $item->slug) }}" class="text-blue-500 hover:underline">Читать далее</a>
                </div>
            </article>
        @endforeach
    </div>
@endsection
