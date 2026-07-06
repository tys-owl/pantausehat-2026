<x-guest-layout>
    <h1 class="font-display font-bold text-2xl text-center mb-1">Selamat Datang Kembali</h1>
    <p class="text-sm text-center text-gray-500 mb-6">Masuk untuk lanjut pantau hidrasi & tidurmu.</p>

    <x-validation-errors class="mb-4 text-sm text-red-600" />

    @session('status')
        <div class="mb-4 text-sm font-medium text-[var(--sage-600)]">{{ $value }}</div>
    @endsession

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
        </div>

        <div>
            <x-input-label for="password" value="Password" />
            <x-text-input id="password" type="password" name="password" required autocomplete="current-password" />
        </div>

        <div class="flex items-center justify-between text-sm">
            <label class="inline-flex items-center gap-2 text-[var(--body-text)]">
                <input type="checkbox" name="remember" class="rounded border-[var(--sage-300)] text-[var(--sage-500)] focus:ring-[var(--sage-500)]">
                Ingat saya
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-[var(--sage-600)] hover:underline">Lupa password?</a>
            @endif
        </div>

        <x-primary-button>Masuk</x-primary-button>

        <p class="text-center text-sm text-gray-500 pt-2">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-[var(--sage-600)] font-medium hover:underline">Daftar</a>
        </p>
    </form>
</x-guest-layout>
