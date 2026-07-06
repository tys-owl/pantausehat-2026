<x-guest-layout>
    <h1 class="font-display font-bold text-2xl text-center mb-1">Buat Akun</h1>
    <p class="text-sm text-center text-gray-500 mb-6">Mulai pantau kesehatanmu bersama HealthSync.</p>

    <x-validation-errors class="mb-4 text-sm text-red-600" />

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <x-input-label for="name" value="Nama" />
            <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
        </div>

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" />
        </div>

        <div>
            <x-input-label for="password" value="Password" />
            <x-text-input id="password" type="password" name="password" required autocomplete="new-password" />
        </div>

        <div>
            <x-input-label for="password_confirmation" value="Konfirmasi Password" />
            <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
        </div>

        <x-primary-button>Daftar</x-primary-button>

        <p class="text-center text-sm text-gray-500 pt-2">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-[var(--sage-600)] font-medium hover:underline">Masuk</a>
        </p>
    </form>
</x-guest-layout>
