<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SkyLinee') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Menggunakan Tailwind CDN menggantikan Vite -->
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    </head>
    <body class="font-sans text-slate-900 antialiased bg-slate-50">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <!-- Logo Khas SkyLinee -->
            <div class="mb-4">
                <a href="/" class="text-3xl font-black tracking-wider text-blue-600 flex items-center gap-2">
                    ✈ SkyLinee
                </a>
            </div>

            <!-- Kotak Form Registrasi / Login -->
            <div class="w-full sm:max-w-md mt-2 px-8 py-8 bg-white border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden sm:rounded-3xl">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>