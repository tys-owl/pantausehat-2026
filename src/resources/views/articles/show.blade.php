<x-app-layout>
    <x-slot name="header">
        <div class="space-y-1">
            <a href="{{ route('articles.index') }}" class="text-[var(--sage-600)] text-sm hover:underline">&larr; Kembali ke Artikel</a>
            <h2 class="font-display font-bold text-xl text-[var(--ink)]">{{ $article->title }}</h2>
        </div>
    </x-slot>

    <div class="py-8 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        @if ($article->image_path)
            <img src="{{ asset('storage/' . $article->image_path) }}" class="rounded-2xl mb-6 w-full max-h-96 object-cover">
        @endif
        <div class="prose max-w-none bg-white p-6 rounded-2xl shadow-sm">
            {!! $article->content !!}
        </div>
    </div>
</x-app-layout>