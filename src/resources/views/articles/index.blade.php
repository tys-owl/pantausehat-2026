<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display font-bold text-xl text-[var(--ink)]">Artikel Kesehatan</h2>
    </x-slot>

    <div class="py-8 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-3 gap-6">
            @foreach ($articles as $article)
                <a href="{{ route('articles.show', $article) }}" class="group block bg-white rounded-2xl shadow-sm hover:shadow-md transition overflow-hidden">
                    <div class="aspect-[4/3] overflow-hidden bg-[var(--sage-100)]">
                        @if ($article->image_path)
                            <img src="{{ asset('storage/' . $article->image_path) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-10 h-10 text-[var(--sage-500)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="px-5 pt-4 pb-5">
                        <p class="text-xs text-[var(--sage-600)] font-medium mb-1">{{ $article->created_at->format('d M Y') }}</p>
                        <h3 class="font-display font-semibold text-base text-[var(--ink)] leading-snug line-clamp-2">
                            {{ $article->title }}
                        </h3>
                        <span class="inline-block mt-3 text-sm text-[var(--sage-600)] font-medium group-hover:underline">
                            Baca selengkapnya →
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="mt-8">{{ $articles->links() }}</div>
    </div>
</x-app-layout>