<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

{{-- Ganti overflow-hidden jadi overflow-x-hidden agar bisa scroll vertikal di mobile --}}

<body class="font-sans text-gray-900 antialiased selection:bg-rose-600 overflow-x-hidden md:overflow-hidden">
    {{-- Tambahkan py-20 di mobile supaya form tidak nempel mentok atas-bawah saat di-scroll --}}
    <div
        class="min-h-screen flex flex-col items-center justify-center bg-[#fafafa] dark:bg-gray-950 relative py-20 md:py-0">

        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            {{-- Text Background: Kita kecilkan ukurannya di mobile agar tidak menabrak form --}}
            <div
                class="absolute left-2 md:left-4 top-1/2 -translate-y-1/2 -rotate-90 origin-left text-[8vh] md:text-[12vh] font-black text-gray-900/3 dark:text-white/2 uppercase leading-none whitespace-nowrap select-none">
                Est. 2026 — Fashion Aura
            </div>

            <div
                class="absolute -top-24 -right-24 w-80 h-80 md:w-150 md:h-150 bg-rose-500/8 dark:bg-rose-600/5 rounded-full blur-[100px] md:blur-[150px]">
            </div>
            <div
                class="absolute -bottom-24 -left-24 w-80 h-80 md:w-150 md:h-150 bg-blue-500/5 dark:bg-blue-600/3 rounded-full blur-[100px] md:blur-[150px]">
            </div>

            {{-- Fix syntax bg-size untuk grid --}}
            <div
                class="absolute inset-0 bg-[linear-gradient(to_right,#80808012_1px,transparent_1px),linear-gradient(to_bottom,#80808012_1px,transparent_1px)] bg-size-[40px_40px]">
            </div>
        </div>

        {{-- Logo: Pindah ke px-6 di mobile agar tidak terpotong --}}
        <div class="absolute top-8 md:top-12 left-0 w-full px-6 md:px-12 flex justify-start items-center z-50">
            <a href="/" class="group">
                <span
                    class="text-xl md:text-2xl font-black tracking-tighter text-gray-900 dark:text-white uppercase transition-all duration-500 group-hover:tracking-widest">
                    FASHION<span class="text-rose-600 italic">AURA</span>
                </span>
            </a>
        </div>

        <main class="relative z-10 w-full flex flex-col items-center px-6 sm:px-0">
            {{-- Dot Divider: Sembunyikan di layar sangat pendek (mobile landscape) --}}
            <div class="hidden xs:flex items-center gap-4 mb-8 opacity-50">
                <div class="h-px w-8 md:w-12 bg-gray-900 dark:bg-white"></div>
                <div class="w-2 h-2 rounded-full border border-gray-900 dark:border-white animate-ping"></div>
                <div class="h-px w-8 md:w-12 bg-gray-900 dark:bg-white"></div>
            </div>

            {{-- Form Container: max-w-110 di desktop, full-width yang aman di mobile --}}
            <div class="w-full sm:max-w-110">
                <div class="relative">
                    {{-- Siku-siku: Sedikit lebih kecil di mobile agar manis --}}
                    <div
                        class="absolute -top-2 -left-2 md:-top-4 md:-left-4 w-8 h-8 md:w-12 md:h-12 border-t-4 border-l-4 border-rose-600">
                    </div>
                    <div
                        class="absolute -bottom-2 -right-2 md:-bottom-4 md:-right-4 w-8 h-8 md:w-12 md:h-12 border-b-4 border-r-4 border-gray-900 dark:border-white">
                    </div>

                    <div class="bg-white/40 dark:bg-gray-900/40 backdrop-blur-md p-1 md:p-2 border border-white/10">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </main>

        {{-- Footer: Reposisi di mobile --}}
        <div
            class="absolute bottom-8 md:bottom-12 left-0 w-full px-6 md:px-12 flex justify-end items-center z-50 opacity-60">
            <div class="text-2xs md:text-xs font-bold uppercase tracking-[0.2em] dark:text-white">
                Couture & Confidence
            </div>
        </div>
    </div>

    @include('sweetalert::alert')
</body>

</html>
