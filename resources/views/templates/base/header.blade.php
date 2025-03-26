<nav class="bg-white shadow-md">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <div class="flex items-center">
                <a href="/" class="text-xl font-bold text-gray-800">
                    {{ $_SERVER['HTTP_HOST'] }}
                </a>
            </div>
            <div class="hidden md:flex items-center space-x-4">
                <a href="/" class="text-gray-600 hover:text-gray-900">Home</a>
{{--                <a href="{{ route('categories.index') }}" class="text-gray-600 hover:text-gray-900">Категории</a>--}}
{{--                <a href="{{ route('about') }}" class="text-gray-600 hover:text-gray-900">О нас</a>--}}
{{--                <a href="{{ route('contact') }}" class="text-gray-600 hover:text-gray-900">Контакты</a>--}}
            </div>
            <div class="md:hidden">
                <button type="button" class="text-gray-600 hover:text-gray-900 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>
