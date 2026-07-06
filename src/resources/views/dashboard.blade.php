<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display font-bold text-xl text-[var(--ink)]">Dashboard</h2>
    </x-slot>

    <div class="py-8 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="text-[var(--body-text)] mb-6">Selamat datang kembali, {{ Auth::user()->name }}! Pilih menu di bawah.</p>

        <div class="grid sm:grid-cols-2 gap-5">
            <a href="{{ route('water.calculator') }}" class="group bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition">
                <div class="w-11 h-11 rounded-xl bg-[var(--sage-100)] flex items-center justify-center mb-4 group-hover:bg-[var(--sage-500)] transition">
                    <svg class="w-5 h-5 text-[var(--sage-600)] group-hover:text-white transition" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3C12 3 6 11 6 15.5C6 18.5 8.7 21 12 21C15.3 21 18 18.5 18 15.5C18 11 12 3 12 3Z"/>
                    </svg>
                </div>
                <h3 class="font-display font-semibold text-lg text-[var(--ink)] mb-1">Kebutuhan Air</h3>
                <p class="text-sm text-[var(--body-text)]">Hitung kebutuhan air harianmu.</p>
            </a>

            <a href="{{ route('sleep.calculator') }}" class="group bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition">
                <div class="w-11 h-11 rounded-xl bg-[var(--sage-100)] flex items-center justify-center mb-4 group-hover:bg-[var(--sage-500)] transition">
                    <svg class="w-5 h-5 text-[var(--sage-600)] group-hover:text-white transition" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 12.5C18.5 14.5 16.2 15.5 13.7 15.1C10.2 14.5 7.6 11.5 7.8 8C7.9 6.4 8.5 5 9.4 3.9C5.6 4.9 3 8.4 3 12.5C3 17.2 6.8 21 11.5 21C15.5 21 18.9 18.4 20 14.8"/>
                    </svg>
                </div>
                <h3 class="font-display font-semibold text-lg text-[var(--ink)] mb-1">Kebutuhan Tidur</h3>
                <p class="text-sm text-[var(--body-text)]">Cek sleep debt kamu.</p>
            </a>

            <a href="{{ route('articles.index') }}" class="group bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition">
                <div class="w-11 h-11 rounded-xl bg-[var(--sage-100)] flex items-center justify-center mb-4 group-hover:bg-[var(--sage-500)] transition">
                    <svg class="w-5 h-5 text-[var(--sage-600)] group-hover:text-white transition" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 5.5C4 4.7 4.7 4 5.5 4H10.5C11.3 4 12 4.7 12 5.5V19.5C12 18.7 11.3 18 10.5 18H4V5.5Z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 5.5C20 4.7 19.3 4 18.5 4H13.5C12.7 4 12 4.7 12 5.5V19.5C12 18.7 12.7 18 13.5 18H20V5.5Z"/>
                    </svg>
                </div>
                <h3 class="font-display font-semibold text-lg text-[var(--ink)] mb-1">Artikel Kesehatan</h3>
                <p class="text-sm text-[var(--body-text)]">Baca tips seputar hidrasi & tidur.</p>
            </a>

            <a href="{{ route('history.index') }}" class="group bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition">
                <div class="w-11 h-11 rounded-xl bg-[var(--sage-100)] flex items-center justify-center mb-4 group-hover:bg-[var(--sage-500)] transition">
                    <svg class="w-5 h-5 text-[var(--sage-600)] group-hover:text-white transition" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3V21H21M7 15L11 10L14 13L19 7"/>
                    </svg>
                </div>
                <h3 class="font-display font-semibold text-lg text-[var(--ink)] mb-1">Histori & Grafik</h3>
                <p class="text-sm text-[var(--body-text)]">Lihat perkembangan mingguanmu.</p>
            </a>
        </div>
    </div>
</x-app-layout>
