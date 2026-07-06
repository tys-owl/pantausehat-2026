<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
        
        <!-- Scripts -->
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
            body { font-family: 'Inter', sans-serif; background: var(--bg-mint); }
            .font-display { font-family: 'Quicksand', sans-serif; color: var(--ink); }
            h1, h2, h3 { font-family: 'Quicksand', sans-serif; }
        </style>

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-[var(--bg-mint)]">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
