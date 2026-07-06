<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'HealthSync') }}</title>
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
        }
        body { font-family: 'Inter', sans-serif; color: var(--body-text); background: var(--bg-mint); }
        .font-display { font-family: 'Quicksand', sans-serif; color: var(--ink); }
        a:focus-visible, button:focus-visible, input:focus-visible {
            outline: 2px solid var(--sage-600); outline-offset: 2px;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center px-4 py-10 relative overflow-hidden">

    <div class="absolute -top-24 -left-24 w-72 h-72 rounded-full bg-[var(--sage-100)] blur-2xl opacity-70"></div>
    <div class="absolute -bottom-24 -right-24 w-80 h-80 rounded-full bg-[var(--sage-300)] blur-2xl opacity-40"></div>

    <div class="relative w-full max-w-md">
        <a href="{{ route('home') }}" class="flex items-center justify-center gap-2 mb-6 font-display font-bold text-xl">
            @php($setting = \App\Models\WebsiteSetting::current())
            @if ($setting->logo)
                <img src="{{ asset('storage/' . $setting->logo) }}" class="h-9 w-9 object-contain">
            @endif
            {{ $setting->site_name }}
        </a>

        <div class="bg-white rounded-3xl shadow-sm px-8 py-9">
            {{ $slot }}
        </div>
    </div>

</body>
</html>