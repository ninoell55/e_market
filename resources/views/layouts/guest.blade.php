<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-white dark:bg-gray-950 relative overflow-hidden">

        <div class="absolute top-0 left-0 w-full h-full -z-10">
            <div
                class="absolute top-[-10%] left-[-10%] w-125 h-125 bg-rose-200/30 dark:bg-rose-900/20 rounded-full blur-[120px] animate-pulse">
            </div>
            <div
                class="absolute bottom-[-10%] right-[-10%] w-100 h-100 bg-blue-100/30 dark:bg-blue-900/10 rounded-full blur-[100px]">
            </div>

            <div
                class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-[0.03] dark:opacity-[0.05]">
            </div>
        </div>

        <div class="mb-6 relative z-10 transition-transform duration-500 hover:scale-110">
            <a href="/" class="flex flex-col items-center gap-2">
                <span class="text-3xl font-black tracking-tighter text-gray-900 dark:text-white uppercase">
                    Fashion<span class="text-rose-600 italic">Aura</span>
                </span>
                <div class="h-1 w-12 bg-rose-600 rounded-full"></div>
            </a>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-8 py-10 bg-white/70 dark:bg-gray-900/60 backdrop-blur-2xl shadow-[0_20px_50px_rgba(0,0,0,0.1)] dark:shadow-none border border-white/20 dark:border-gray-800 sm:rounded-[2.5rem] relative z-10">
            {{ $slot }}
        </div>

        <div class="mt-8 text-2xs font-bold uppercase tracking-[0.3em] text-gray-400 relative z-10">
            &copy; 2026 FashionAura Boutique
        </div>
    </div>
</body>

</html>
