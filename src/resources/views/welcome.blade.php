<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $setting->site_name }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --ink: #1F2E27;
            --body-text: #46564B;
            --bg-mint: #F5FBF7;
            --sage-100: #E1F1E6;
            --sage-300: #A9D4B7;
            --sage-500: #4F9E76;
            --sage-600: #3E8563;
            --cream: #FFF9F0;
        }
        body {
            font-family: 'Inter', sans-serif;
            color: var(--body-text);
            background: var(--bg-mint);
        }
        .font-display {
            font-family: 'Quicksand', sans-serif;
            color: var(--ink);
        }
        .btn-primary {
            background: var(--sage-500);
            color: #fff;
            transition: background .15s ease, transform .15s ease;
        }
        .btn-primary:hover { background: var(--sage-600); transform: translateY(-1px); }
        .btn-outline {
            border: 1.5px solid var(--sage-500);
            color: var(--sage-600);
            transition: background .15s ease;
        }
        .btn-outline:hover { background: var(--sage-100); }
        a:focus-visible, button:focus-visible {
            outline: 2px solid var(--sage-600);
            outline-offset: 2px;
        }
        @media (prefers-reduced-motion: reduce) {
            .btn-primary, .btn-outline { transition: none; }
        }
        .hero-blob {
            background: linear-gradient(135deg, var(--sage-300), var(--sage-100));
            border-radius: 42% 58% 63% 37% / 45% 40% 60% 55%;
        }
        .prose :where(p) { margin-bottom: .75em; }
    </style>
</head>
<body>

    <!-- 1. Bagian Navigasi yang Sudah Disederhanakan -->
    <header class="bg-white/80 backdrop-blur sticky top-0 z-50 border-b border-[var(--sage-100)]">
        <nav class="max-w-6xl mx-auto flex items-center justify-between px-6 py-4">
            <div class="flex items-center gap-2 font-display font-bold text-xl">
                @if ($setting->logo)
                    <img src="{{ asset('storage/' . $setting->logo) }}" class="h-9 w-9 object-contain">
                @endif
                {{ $setting->site_name }}
            </div>
            <a href="#tentang" class="btn-outline px-5 py-2 rounded-full text-sm font-medium">About</a>
        </nav>
    </header>

    <!-- 2. Bagian Hero Beranda dengan CTA Login & Registrasi Baru -->
    <section id="beranda" class="relative overflow-hidden pb-24">
        <div class="max-w-6xl mx-auto px-6 pt-16 md:pt-24 grid md:grid-cols-2 gap-12 items-center">
            <div>
                <h1 class="font-display font-bold text-4xl md:text-5xl leading-tight mb-4">
                    Selaraskan Hidrasi<br> & Tidurmu
                </h1>
                <p class="text-base md:text-lg mb-8 max-w-md">
                    {{ $setting->site_name }} menghitung kebutuhan air dan mengevaluasi utang tidurmu secara personal — berdasarkan berat badan, usia, dan tingkat aktivitas harianmu.
                </p>
                <div class="flex gap-4">
                    <a href="{{ route('login') }}" class="btn-primary px-6 py-3 rounded-full font-medium">Login</a>
                    <a href="{{ route('register') }}" class="btn-outline px-6 py-3 rounded-full font-medium">Registrasi</a>
                </div>
            </div>
            <div class="relative">
                <div class="hero-blob aspect-square w-full max-w-md mx-auto flex items-center justify-center overflow-hidden">
                    @if ($setting->hero_image)
                        <img src="{{ asset('storage/' . $setting->hero_image) }}" class="w-full h-full object-cover">
                    @else
                        <svg viewBox="0 0 200 200" class="w-2/3 h-2/3" fill="none">
                            <path d="M100 30C100 30 60 90 60 125C60 147 78 165 100 165C122 165 140 147 140 125C140 90 100 30 100 30Z" fill="var(--sage-500)"/>
                            <circle cx="145" cy="55" r="18" fill="var(--sage-600)" opacity="0.5"/>
                        </svg>
                    @endif
                </div>
            </div>
        </div>

        <svg class="absolute bottom-0 left-0 w-full" viewBox="0 0 1440 100" preserveAspectRatio="none">
            <path fill="#ffffff" d="M0,50 C360,100 1080,0 1440,50 L1440,100 L0,100 Z"></path>
        </svg>
    </section>

    <!-- 3. Section Tentang (Tetap Sama Persis) -->
    <section id="tentang" class="bg-white py-16 md:py-24">
        <div class="max-w-3xl mx-auto px-6 text-center">
            <span class="text-xs font-semibold text-[var(--sage-600)] uppercase tracking-wide">About</span>
            <h2 class="font-display font-bold text-2xl md:text-3xl mt-2 mb-6">Mengenal {{ $setting->site_name }}</h2>
            <div class="prose mx-auto text-left md:text-center">
                {!! $setting->about_content ?? '<p>Belum ada deskripsi.</p>' !!}
            </div>
            @if ($setting->contact_email)
                <p class="text-sm mt-6 text-[var(--sage-600)]">{{ $setting->contact_email }}</p>
            @endif
        </div>

        <div class="max-w-5xl mx-auto px-6 mt-16 grid md:grid-cols-3 gap-6">
            <div class="bg-[var(--bg-mint)] rounded-2xl p-6">
                <div class="w-10 h-10 rounded-full bg-[var(--sage-100)] flex items-center justify-center mb-4">
                    <svg class="w-5 h-5" fill="none" stroke="var(--sage-600)" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3C12 3 6 11 6 15.5C6 18.5 8.7 21 12 21C15.3 21 18 18.5 18 15.5C18 11 12 3 12 3Z"/></svg>
                </div>
                <h3 class="font-display font-semibold mb-1">Perhitungan Akurat</h3>
                <p class="text-sm">Berdasarkan standar pemenuhan nutrisi dan hidrasi harian, bukan asumsi rata-rata.</p>
            </div>
            <div class="bg-[var(--bg-mint)] rounded-2xl p-6">
                <div class="w-10 h-10 rounded-full bg-[var(--sage-100)] flex items-center justify-center mb-4">
                    <svg class="w-5 h-5" fill="none" stroke="var(--sage-600)" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21C16.97 21 21 16.97 21 12C21 10.5 20.63 9.09 20 7.83C19.4 10.5 17.13 12.5 14.4 12.5C11.19 12.5 8.58 9.89 8.58 6.68C8.58 5.24 9.1 3.93 9.95 2.92C5.4 3.65 3 7.5 3 12C3 16.97 7.03 21 12 21Z"/></svg>
                </div>
                <h3 class="font-display font-semibold mb-1">Pantau Utang Tidur</h3>
                <p class="text-sm">Hitung kekurangan jam tidur malammu dan dapatkan rekomendasi waktu istirahat yang ideal secara personal.</p>
            </div>
            <div class="bg-[var(--bg-mint)] rounded-2xl p-6">
                <div class="w-10 h-10 rounded-full bg-[var(--sage-100)] flex items-center justify-center mb-4">
                    <svg class="w-5 h-5" fill="none" stroke="var(--sage-600)" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3V21H21M7 15L11 10L14 13L19 7"/></svg>
                </div>
                <h3 class="font-display font-semibold mb-1">Pantau Perkembangan</h3>
                <p class="text-sm">Grafik histori mingguan bantu kamu lihat perkembangan hidrasi dan tidurmu.</p>
            </div>
        </div>
    </section>

    <!-- 4. Section <section id="artikel"> Lama Sudah Dihapus Total Sesuai Perintah, Langsung ke Footer -->
    <footer class="bg-[var(--ink)] text-[var(--sage-100)] text-center py-8 text-sm">
        © {{ date('Y') }} {{ $setting->site_name }}. Bukan pengganti diagnosis medis.
    </footer>

</body>
</html>