<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    {{-- META --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- TITLE --}}
    <title>{{ config('app.name', 'Laravel') }}</title>
    {{-- ICON --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif


    <!-- ==================
        NAVBAR
    ====================== -->
    <header id="site-header" class="fixed top-0 left-0 w-full z-50 transition-all duration-300 bg-transparent">
        <div class="relative z-20 py-4">
            <div class="px-6 md:px-12 lg:container lg:mx-auto xl:px-40 lg:py-4 transition-all duration-300"
                id="header-container">
                <div class="flex items-center justify-between">
                    <div class="relative z-20">
                        <a class="flex items-center gap-2 text-3xl font-extrabold text-gray-900 dark:text-white transition-transform duration-300 hover:scale-105 font-rubik-vinyl"
                            href="#">
                            <span class="tracking-tighter">Fashion<span class="text-rose-600 italic">Aura</span></span>
                            <img class="h-7 w-auto" src="{{ asset('assets/img/icons/logo.png') }}" alt="Logo">
                        </a>
                    </div>

                    <div class="flex items-center justify-end">
                        <input type="checkbox" name="hamburger" id="hamburger" class="hidden peer">

                        <label for="hamburger" class="relative z-20 block p-2 cursor-pointer lg:hidden group">
                            <div class="space-y-1.5">
                                <div aria-hidden="true"
                                    class="h-0.5 w-6 rounded bg-gray-900 dark:bg-white transition duration-300 group-hover:bg-rose-600">
                                </div>
                                <div aria-hidden="true"
                                    class="h-0.5 w-6 rounded bg-gray-900 dark:bg-white transition duration-300 group-hover:bg-rose-600">
                                </div>
                            </div>
                        </label>

                        <div
                            class="peer-checked:translate-x-0 fixed inset-0 w-full md:w-100 lg:w-auto -translate-x-full lg:translate-x-0 bg-white/95 dark:bg-gray-950/95 backdrop-blur-xl lg:backdrop-blur-none transition-transform duration-500 lg:static lg:bg-transparent lg:shadow-none">
                            <div class="flex flex-col justify-between h-full lg:items-center lg:flex-row">
                                <ul
                                    class="px-10 pt-32 space-y-8 text-sm font-bold uppercase tracking-[0.2em] text-gray-700 dark:text-gray-300 lg:space-y-0 lg:flex lg:space-x-10 lg:pt-0 lg:px-8">
                                    <li>
                                        <a href="#home" data-nav="home"
                                            class="nav-link relative text-rose-600 transition-colors">
                                            Home
                                            <span class="absolute -bottom-2 left-0 w-8 h-0.5 bg-rose-600"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#tentang" data-nav="tentang"
                                            class="nav-link hover:text-rose-600 transition-colors relative group">
                                            About
                                            <span
                                                class="absolute -bottom-2 left-0 w-0 h-0.5 bg-rose-600 transition-all duration-300 group-hover:w-full"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#layanan" data-nav="layanan"
                                            class="nav-link hover:text-rose-600 transition-colors relative group">
                                            Services
                                            <span
                                                class="absolute -bottom-2 left-0 w-0 h-0.5 bg-rose-600 transition-all duration-300 group-hover:w-full"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#produk" data-nav="produk"
                                            class="nav-link hover:text-rose-600 transition-colors relative group">
                                            Products
                                            <span
                                                class="absolute -bottom-2 left-0 w-0 h-0.5 bg-rose-600 transition-all duration-300 group-hover:w-full"></span>
                                        </a>
                                    </li>
                                </ul>

                                @if (Route::has('login'))
                                    <nav
                                        class="flex flex-col lg:flex-row items-center gap-4 px-10 py-12 border-t border-gray-100 dark:border-gray-800 lg:border-none lg:py-0 lg:pr-0 lg:pl-8">
                                        @auth
                                            <a href="{{ route(Auth::user()->getDashboardRouteName()) }}"
                                                class="w-full lg:w-auto text-center px-6 py-2.5 bg-gray-900 dark:bg-white dark:text-gray-950 text-white rounded-xl text-xs font-bold uppercase tracking-widest hover:bg-rose-600 dark:hover:bg-rose-600 dark:hover:text-white transition-all duration-300 shadow-lg shadow-gray-200 dark:shadow-none">
                                                Dashboard
                                            </a>
                                        @else
                                            <a href="{{ route('login') }}"
                                                class="w-full lg:w-auto text-center px-6 py-2.5 text-gray-700 dark:text-gray-300 text-xs font-bold uppercase tracking-widest hover:text-rose-600 transition-colors">
                                                Log in
                                            </a>

                                            @if (Route::has('register'))
                                                <a href="{{ route('register') }}"
                                                    class="w-full lg:w-auto text-center px-6 py-2.5 bg-rose-600 text-white rounded-xl text-xs font-bold uppercase tracking-widest hover:bg-rose-700 transition-all duration-300 shadow-lg shadow-rose-200 dark:shadow-none">
                                                    Register
                                                </a>
                                            @endif
                                        @endauth
                                    </nav>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- ==================
        NAVBAR-end
    ====================== -->
    <div class="h-20 lg:h-28 bg-white dark:bg-gray-900"></div>



    <!-- ==================
        HERO
    ====================== -->
    <section id="home" class="relative overflow-hidden bg-white dark:bg-gray-900">
        <div class="container px-6 pt-8 md:pb-36 pb-8 mx-auto lg:px-12 xl:px-40">
            <div class="grid grid-cols-1 gap-12 lg:grid-cols-12 lg:items-center">

                <div class="lg:col-span-6 xl:col-span-5 order-2 lg:order-1">
                    <div class="space-y-8">
                        <div class="inline-flex items-center space-x-2">
                            <span class="w-12 h-px bg-rose-600"></span>
                            <span class="text-sm font-bold tracking-widest text-rose-600 uppercase">Premium
                                Boutique</span>
                        </div>

                        <h1 class="text-5xl font-black tracking-tight text-gray-900 dark:text-white xl:text-7xl">
                            Elevate Your <br>
                            <span class="text-rose-600">Daily Aura.</span>
                        </h1>

                        <p class="text-lg leading-relaxed text-gray-600 dark:text-gray-400">
                            Experience the perfect blend of comfort and high-fashion. Our 2026 collection brings you
                            curated essentials designed to redefine your personal style.
                        </p>

                        <div class="flex flex-col space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4">
                            <a href="#produk"
                                class="flex items-center justify-center px-10 py-4 text-sm font-bold tracking-widest text-white uppercase transition-all duration-300 bg-gray-900 dark:bg-rose-600 rounded-full hover:bg-rose-600 dark:hover:bg-rose-700 shadow-xl">
                                Shop Collection
                            </a>
                            <a href="#tentang"
                                class="flex items-center justify-center px-10 py-4 text-sm font-bold tracking-widest text-gray-900 dark:text-white uppercase transition-all duration-300 border-2 border-gray-200 dark:border-gray-800 rounded-full hover:border-gray-900 dark:hover:border-rose-600">
                                Our Story
                            </a>
                        </div>

                        <div class="pt-10 flex items-center justify-center gap-10">
                            <div>
                                <p class="text-2xl font-black text-gray-900 dark:text-white">99%</p>
                                <p class="text-xs uppercase tracking-widest text-gray-500">Satisfaction</p>
                            </div>
                            <div class="w-px h-8 bg-gray-200 dark:bg-gray-800"></div>
                            <div>
                                <p class="text-2xl font-black text-gray-900 dark:text-white">24h</p>
                                <p class="text-xs uppercase tracking-widest text-gray-500">Shipping</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-6 xl:col-span-7 order-1 lg:order-2">
                    <div class="relative grid grid-cols-12 gap-4">
                        <div
                            class="col-span-8 overflow-hidden rounded-3xl shadow-2xl transition-transform duration-500 hover:scale-[1.02]">
                            <img class="object-cover w-full h-100 lg:h-150" src="{{ asset('assets/img/hero.jpg') }}"
                                alt="Main Fashion Look">
                        </div>

                        <div class="col-span-4 flex flex-col gap-4">
                            <div
                                class="h-1/2 overflow-hidden rounded-3xl shadow-xl transition-transform duration-500 hover:scale-[1.05]">
                                <img class="object-cover w-full h-full"
                                    src="https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=2012&auto=format&fit=crop"
                                    alt="Shoes Collection">
                            </div>
                            <div
                                class="h-1/2 overflow-hidden rounded-3xl shadow-xl transition-transform duration-500 hover:scale-[1.05] bg-black hover:bg-rose-600 flex items-center justify-center">
                                <div class="text-center text-white p-4">
                                    <p class="text-3xl font-black italic">NEW</p>
                                    <p class="text-xs uppercase font-bold tracking-tighter">Arrivals 2026</p>
                                </div>
                            </div>
                        </div>

                        <div
                            class="absolute -bottom-6 -right-6 -z-10 w-64 h-64 bg-rose-100 dark:bg-rose-900/20 rounded-full blur-3xl">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- ==================
        HERO-end
    ====================== -->



    <!-- ==================
        second_HERO
    ====================== -->
    <section class="py-20 bg-white dark:bg-gray-900 font-inter">
        <div class="container px-6 mx-auto lg:px-12 xl:px-40">
            <div
                class="relative overflow-hidden bg-rose-50 dark:bg-gray-800 rounded-[3rem] p-8 md:p-20 shadow-sm border border-rose-100 dark:border-gray-700">

                <div
                    class="absolute top-0 right-0 w-64 h-64 bg-rose-200/50 dark:bg-rose-500/10 blur-3xl -translate-y-1/2 translate-x-1/2 rounded-full">
                </div>

                <div class="grid grid-cols-1 gap-12 lg:grid-cols-2 items-center relative z-10">

                    <div class="text-center lg:text-left">
                        <h2
                            class="text-4xl font-black leading-tight tracking-tight text-gray-900 md:text-6xl dark:text-white uppercase">
                            This is <br>
                            <span class="text-rose-600">Fashion Aura.</span>
                        </h2>

                        <p class="mt-6 text-lg font-medium text-gray-600 md:text-xl dark:text-gray-400">
                            Join the revolution of style. We don't just sell clothes; we provide the confidence to
                            redefine who you are.
                        </p>

                        <div class="flex flex-wrap justify-center lg:justify-start gap-4 mt-10">
                            <a href="#about"
                                class="px-8 py-4 text-sm font-bold tracking-widest text-white uppercase transition-all duration-300 bg-rose-600 rounded-full hover:bg-rose-700 hover:shadow-lg hover:shadow-rose-500/30">
                                Learn Our Story
                            </a>
                            <a href="https://wa.me/yournumber"
                                class="px-8 py-4 text-sm font-bold tracking-widest text-rose-600 uppercase transition-all duration-300 border-2 border-rose-600 rounded-full hover:bg-rose-600 hover:text-white">
                                Get In Touch
                            </a>
                        </div>
                    </div>

                    <div class="relative flex items-center justify-center p-6">
                        <div
                            class="relative z-20 p-8 md:p-12 bg-gray-900 dark:bg-white shadow-2xl rounded-3xl transform rotate-3 hover:rotate-0 transition-transform duration-500">
                            <h3 class="text-2xl md:text-3xl font-black uppercase text-white dark:text-gray-900">
                                Fashion.<br>Aura.<br>Global.
                            </h3>
                            <div class="w-12 h-1 bg-rose-500 mt-4"></div>
                            <p class="mt-4 text-sm font-medium text-gray-400 dark:text-gray-500 italic">
                                "Your look, your statement."
                            </p>
                        </div>

                        <div
                            class="absolute z-10 -top-4 -right-4 w-24 h-24 bg-rose-500 rounded-2xl rotate-12 opacity-20 animate-pulse">
                        </div>
                        <div
                            class="absolute z-10 -bottom-4 -left-4 w-32 h-32 border-4 border-rose-500 rounded-full opacity-20">
                        </div>
                    </div>

                </div>
            </div>

            <div
                class="mt-16 flex flex-wrap justify-center gap-8 opacity-40 grayscale transition-all duration-500 hover:grayscale-0">
                <span class="text-xl font-bold tracking-tighter text-gray-400">AUTHENTIC</span>
                <span class="text-xl font-bold tracking-tighter text-gray-400">MODERN</span>
                <span class="text-xl font-bold tracking-tighter text-gray-400">STYLISH</span>
            </div>
        </div>
    </section>
    <!-- ==================
        second_HERO-end
    ====================== -->



    <!-- ==================
        WHY
    ====================== -->
    <section id="tentang" class="bg-white dark:bg-gray-900 overflow-hidden">
        <div class="container px-6 py-20 mx-auto lg:px-12 xl:px-40">
            <div class="lg:flex lg:items-center lg:gap-16">

                <div class="w-full space-y-12 lg:w-1/2">
                    <div>
                        <div class="inline-flex items-center space-x-2 mb-4">
                            <span class="w-8 h-px bg-rose-500"></span>
                            <span class="text-sm font-bold tracking-widest text-rose-500 uppercase">Who We Are</span>
                        </div>

                        <h2 class="text-4xl font-black text-gray-900 lg:text-5xl dark:text-white leading-tight">
                            Crafting Style, <br>
                            <span
                                class="text-rose-600 underline decoration-rose-200 decoration-4 underline-offset-8">Empowering
                                Locals.</span>
                        </h2>

                        <p class="mt-8 text-lg leading-relaxed text-gray-600 dark:text-gray-400">
                            <span class="font-bold text-gray-900 dark:text-white">FashionAura</span> is a contemporary
                            local brand dedicated to premium apparel, footwear, and accessories. We blend modern trends
                            with the exceptional craftsmanship of Indonesian artisans to elevate your daily look.
                        </p>
                    </div>

                    <div class="grid gap-8 sm:grid-cols-1">
                        <div
                            class="group flex items-start gap-4 p-4 transition-all duration-300 rounded-2xl hover:bg-rose-50 dark:hover:bg-gray-800">
                            <div class="shrink-0 p-3 text-rose-600 bg-rose-100 rounded-xl dark:bg-rose-900/30">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Premium Local Quality</h3>
                                <p class="mt-2 text-gray-600 dark:text-gray-400">Unique designs using high-grade
                                    materials, meticulously crafted with an eye for detail and current trends.</p>
                            </div>
                        </div>

                        <div
                            class="group flex items-start gap-4 p-4 transition-all duration-300 rounded-2xl hover:bg-rose-50 dark:hover:bg-gray-800">
                            <div class="shrink-0 p-3 text-rose-600 bg-rose-100 rounded-xl dark:bg-rose-900/30">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Customer-First Commitment
                                </h3>
                                <p class="mt-2 text-gray-600 dark:text-gray-400">We ensure a seamless shopping
                                    experience with friendly service and a hassle-free transaction process.</p>
                            </div>
                        </div>

                        <div
                            class="group flex items-start gap-4 p-4 transition-all duration-300 rounded-2xl hover:bg-rose-50 dark:hover:bg-gray-800">
                            <div class="shrink-0 p-3 text-rose-600 bg-rose-100 rounded-xl dark:bg-rose-900/30">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Support Local Creative</h3>
                                <p class="mt-2 text-gray-600 dark:text-gray-400">By choosing us, you empower local
                                    MSMEs and artisans, helping the Indonesian creative industry thrive.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative w-full mt-16 lg:w-1/2 lg:mt-0">
                    <div class="relative flex flex-col items-center">
                        <div
                            class="relative z-10 overflow-hidden rounded-4xl shadow-2xl rotate-2 transition-transform duration-500 hover:rotate-0">
                            <img class="object-cover w-full h-125 lg:h-162.5 xl:w-125"
                                src="{{ asset('assets/img/about.jpg') }}" alt="About FashionAura">
                        </div>

                        <div
                            class="absolute -bottom-10 -left-6 z-20 bg-white dark:bg-gray-800 p-8 shadow-2xl rounded-3xl border border-gray-100 dark:border-gray-700 max-w-62.5">
                            <p class="text-rose-600 font-black text-4xl mb-2">100%</p>
                            <p class="text-xs font-bold uppercase tracking-widest text-gray-500 leading-tight">
                                Authentic Indonesian Craftsmanship</p>
                        </div>

                        <div
                            class="absolute -top-10 -right-10 w-64 h-64 bg-rose-100 dark:bg-rose-900/20 rounded-full blur-3xl -z-10">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-24 border-t border-gray-100 dark:border-gray-800"></div>
        </div>
    </section>
    <!-- ==================
        WHY-end
    ====================== -->



    <!-- ==================
        BLOG
    ====================== -->
    <section id="layanan" class="bg-rose-50 dark:bg-gray-950 py-24">
        <div class="container px-6 mx-auto lg:px-12 xl:px-40">
            <div class="text-center mb-16">
                <div class="inline-flex items-center justify-center space-x-2 mb-4">
                    <span class="w-8 h-px bg-rose-500"></span>
                    <span class="text-sm font-bold tracking-widest text-rose-500 uppercase">Our Categories</span>
                    <span class="w-8 h-px bg-rose-500"></span>
                </div>

                <h2 class="text-4xl font-black text-gray-900 lg:text-6xl dark:text-white uppercase leading-tight">
                    Curated <span class="text-rose-600">Collections</span>
                </h2>

                <p class="max-w-2xl mx-auto mt-6 text-lg text-gray-600 dark:text-gray-400">
                    Discover our signature ranges designed to fit every occasion, from high-street casuals to elegant
                    essentials.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-10 lg:grid-cols-3">

                <div
                    class="group relative overflow-hidden rounded-4xl bg-white dark:bg-gray-900 shadow-xl transition-all duration-500 hover:-translate-y-2">
                    <div class="relative h-112.5 overflow-hidden">
                        <img class="object-cover w-full h-full transition-transform duration-700 group-hover:scale-110"
                            src="{{ asset('assets/img/koleksi-baju.jpg') }}" alt="Apparel Collection">
                        <div
                            class="absolute inset-0 bg-linear-to-t from-black/80 via-black/20 to-transparent opacity-60 group-hover:opacity-80 transition-opacity">
                        </div>
                    </div>

                    <div class="absolute bottom-0 left-0 right-0 p-8 text-white">
                        <h3 class="text-3xl font-black uppercase tracking-tight">Apparel</h3>
                        <p
                            class="mt-2 text-sm text-gray-200 line-clamp-2 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            Modern silhouettes designed for versatility—perfect for casual days, office hours, or
                            special nights out.
                        </p>
                        <a href="#"
                            class="inline-flex items-center mt-6 text-sm font-bold tracking-widest uppercase text-rose-400 hover:text-rose-300 transition-colors">
                            Explore Collection
                            <svg class="w-4 h-4 ml-2 group-hover:translate-x-2 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <div
                    class="group relative overflow-hidden rounded-4xl bg-white dark:bg-gray-900 shadow-xl transition-all duration-500 hover:-translate-y-2">
                    <div class="relative h-112.5 overflow-hidden">
                        <img class="object-cover w-full h-full transition-transform duration-700 group-hover:scale-110"
                            src="{{ asset('assets/img/koleksi-sepatu.jpg') }}" alt="Footwear Collection">
                        <div
                            class="absolute inset-0 bg-linear-to-t from-black/80 via-black/20 to-transparent opacity-60 group-hover:opacity-80 transition-opacity">
                        </div>
                    </div>

                    <div class="absolute bottom-0 left-0 right-0 p-8 text-white">
                        <h3 class="text-3xl font-black uppercase tracking-tight">Footwear</h3>
                        <p
                            class="mt-2 text-sm text-gray-200 line-clamp-2 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            Step with confidence in our range of premium shoes. Trendy, durable, and crafted for maximum
                            comfort.
                        </p>
                        <a href="#"
                            class="inline-flex items-center mt-6 text-sm font-bold tracking-widest uppercase text-rose-400 hover:text-rose-300 transition-colors">
                            Explore Collection
                            <svg class="w-4 h-4 ml-2 group-hover:translate-x-2 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <div
                    class="group relative overflow-hidden rounded-4xl bg-white dark:bg-gray-900 shadow-xl transition-all duration-500 hover:-translate-y-2">
                    <div class="relative h-112.5 overflow-hidden">
                        <img class="object-cover w-full h-full transition-transform duration-700 group-hover:scale-110"
                            src="{{ asset('assets/img/koleksi-aksesoris.jpg') }}" alt="Accessories Collection">
                        <div
                            class="absolute inset-0 bg-linear-to-t from-black/80 via-black/20 to-transparent opacity-60 group-hover:opacity-80 transition-opacity">
                        </div>
                    </div>

                    <div class="absolute bottom-0 left-0 right-0 p-8 text-white">
                        <h3 class="text-3xl font-black uppercase tracking-tight">Accessories</h3>
                        <p
                            class="mt-2 text-sm text-gray-200 line-clamp-2 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            The finishing touch. Unique jewelry, hats, and eyewear to complete your signature
                            FashionAura look.
                        </p>
                        <a href="#"
                            class="inline-flex items-center mt-6 text-sm font-bold tracking-widest uppercase text-rose-400 hover:text-rose-300 transition-colors">
                            Explore Collection
                            <svg class="w-4 h-4 ml-2 group-hover:translate-x-2 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- ==================
        BLOG-end
    ====================== -->



    <!-- ==================
        NEW_COLLECTION
    ====================== -->
    <section id="produk" class="bg-white dark:bg-gray-950 py-24">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <header class="text-center mb-20">
                <div class="inline-flex items-center space-x-2 mb-4">
                    <span class="w-12 h-0.5 bg-rose-500"></span>
                    <span class="text-xs font-black tracking-[0.3em] text-rose-500 uppercase">Premium Selection</span>
                    <span class="w-12 h-0.5 bg-rose-500"></span>
                </div>
                <h2 class="text-4xl font-black text-gray-900 sm:text-5xl dark:text-white uppercase tracking-tighter">
                    Featured <span class="text-rose-600">Categories</span>
                </h2>
                <p class="max-w-md mx-auto mt-6 text-gray-500 dark:text-gray-400">
                    Explore our handpicked excellence. From timeless silhouettes to bold contemporary statements.
                </p>
            </header>

            <div class="mb-24">
                <div class="group relative h-87.5 overflow-hidden rounded-4xl shadow-2xl transition-all duration-500">
                    <img src="{{ asset('assets/img/shoes/Vans Authentic.jpg') }}" alt="Shoes"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105">
                    <div
                        class="absolute inset-0 bg-linear-to-r from-black/80 via-black/40 to-transparent flex items-center">
                        <div class="max-w-xl px-12">
                            <h3 class="text-4xl font-black text-white uppercase italic tracking-widest">Footwear</h3>
                            <p class="mt-4 text-gray-300 text-lg">Engineered for comfort, designed for the streets.
                                Step into the new era of style.</p>
                            <a href="#"
                                class="mt-8 inline-flex items-center px-8 py-3 bg-rose-600 text-white text-sm font-bold uppercase tracking-widest rounded-full hover:bg-rose-700 transition-all group/btn">
                                Shop Now
                                <svg class="w-5 h-5 ml-2 transition-transform group-hover/btn:translate-x-2"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <ul class="grid grid-cols-2 gap-6 mt-12 lg:grid-cols-4">
                    <li class="group">
                        <a href="#" class="block">
                            <div class="relative overflow-hidden rounded-3xl aspect-3/4 bg-gray-100 dark:bg-gray-800">
                                <img src="{{ asset('assets/img/shoes/New Balance 574.jpg') }}" alt=""
                                    class="h-full w-full object-cover transition duration-700 group-hover:scale-110" />
                            </div>
                            <div class="mt-4 flex justify-between items-start px-2">
                                <div>
                                    <h3
                                        class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-rose-600 transition-colors uppercase">
                                        Achilles Low</h3>
                                    <p class="text-xs text-gray-500 mt-1 uppercase tracking-widest">Premium Leather</p>
                                </div>
                                <p class="text-sm font-black text-gray-900 dark:text-white">$415.00</p>
                            </div>
                        </a>
                    </li>
                    <li class="group">
                        <a href="#" class="block">
                            <div class="relative overflow-hidden rounded-3xl aspect-3/4 bg-gray-100 dark:bg-gray-800">
                                <img src="{{ asset('assets/img/shoes/Fila Disruptor.jpg') }}" alt=""
                                    class="h-full w-full object-cover transition duration-700 group-hover:scale-110" />
                            </div>
                            <div class="mt-4 flex justify-between items-start px-2">
                                <div>
                                    <h3
                                        class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-rose-600 transition-colors uppercase">
                                        Achilles Low</h3>
                                    <p class="text-xs text-gray-500 mt-1 uppercase tracking-widest">Premium Leather</p>
                                </div>
                                <p class="text-sm font-black text-gray-900 dark:text-white">$415.00</p>
                            </div>
                        </a>
                    </li>
                    <li class="group">
                        <a href="#" class="block">
                            <div class="relative overflow-hidden rounded-3xl aspect-3/4 bg-gray-100 dark:bg-gray-800">
                                <img src="{{ asset('assets/img/shoes/Adidas Samba.jpg') }}" alt=""
                                    class="h-full w-full object-cover transition duration-700 group-hover:scale-110" />
                            </div>
                            <div class="mt-4 flex justify-between items-start px-2">
                                <div>
                                    <h3
                                        class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-rose-600 transition-colors uppercase">
                                        Achilles Low</h3>
                                    <p class="text-xs text-gray-500 mt-1 uppercase tracking-widest">Premium Leather</p>
                                </div>
                                <p class="text-sm font-black text-gray-900 dark:text-white">$415.00</p>
                            </div>
                        </a>
                    </li>
                    <li class="group">
                        <a href="#" class="block">
                            <div class="relative overflow-hidden rounded-3xl aspect-3/4 bg-gray-100 dark:bg-gray-800">
                                <img src="{{ asset('assets/img/shoes/Converse Chuck Taylor All Star.jpg') }}"
                                    alt=""
                                    class="h-full w-full object-cover transition duration-700 group-hover:scale-110" />
                            </div>
                            <div class="mt-4 flex justify-between items-start px-2">
                                <div>
                                    <h3
                                        class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-rose-600 transition-colors uppercase">
                                        Achilles Low</h3>
                                    <p class="text-xs text-gray-500 mt-1 uppercase tracking-widest">Premium Leather</p>
                                </div>
                                <p class="text-sm font-black text-gray-900 dark:text-white">$415.00</p>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="mb-24">
                <div class="group relative h-87.5 overflow-hidden rounded-4xl shadow-2xl transition-all duration-500">
                    <img src="{{ asset('assets/img/clothes/Denim Jacket.jpg') }}" alt="Apparel"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105">
                    <div
                        class="absolute inset-0 bg-linear-to-r from-black/80 via-black/40 to-transparent flex items-center">
                        <div class="max-w-xl px-12">
                            <h3 class="text-4xl font-black text-white uppercase italic tracking-widest">Apparel</h3>
                            <p class="mt-4 text-gray-300 text-lg">From essential basics to statement pieces. Wear your
                                aura.</p>
                            <a href="#"
                                class="mt-8 inline-flex items-center px-8 py-3 bg-rose-600 text-white text-sm font-bold uppercase tracking-widest rounded-full hover:bg-rose-700 transition-all group/btn">
                                Explore All
                                <svg class="w-5 h-5 ml-2 transition-transform group-hover/btn:translate-x-2"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <ul class="grid grid-cols-2 gap-6 mt-12 lg:grid-cols-4">
                    <li class="group">
                        <a href="#" class="block">
                            <div class="relative overflow-hidden rounded-3xl aspect-3/4 bg-gray-100 dark:bg-gray-800">
                                <img src="{{ asset('assets/img/clothes/Blazer.jpg') }}" alt=""
                                    class="h-full w-full object-cover transition duration-700 group-hover:scale-110" />
                            </div>
                            <div class="mt-4 flex justify-between items-start px-2">
                                <div>
                                    <h3
                                        class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-rose-600 transition-colors uppercase">
                                        Structured Blazer</h3>
                                    <p class="text-xs text-gray-500 mt-1 uppercase tracking-widest">Tailored Fit</p>
                                </div>
                                <p class="text-sm font-black text-gray-900 dark:text-white">$185.00</p>
                            </div>
                        </a>
                    </li>
                    <li class="group">
                        <a href="#" class="block">
                            <div class="relative overflow-hidden rounded-3xl aspect-3/4 bg-gray-100 dark:bg-gray-800">
                                <img src="{{ asset('assets/img/clothes/Culottes.jpg') }}" alt=""
                                    class="h-full w-full object-cover transition duration-700 group-hover:scale-110" />
                            </div>
                            <div class="mt-4 flex justify-between items-start px-2">
                                <div>
                                    <h3
                                        class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-rose-600 transition-colors uppercase">
                                        Structured Blazer</h3>
                                    <p class="text-xs text-gray-500 mt-1 uppercase tracking-widest">Tailored Fit</p>
                                </div>
                                <p class="text-sm font-black text-gray-900 dark:text-white">$185.00</p>
                            </div>
                        </a>
                    </li>
                    <li class="group">
                        <a href="#" class="block">
                            <div class="relative overflow-hidden rounded-3xl aspect-3/4 bg-gray-100 dark:bg-gray-800">
                                <img src="{{ asset('assets/img/clothes/Chino Pants.jpg') }}" alt=""
                                    class="h-full w-full object-cover transition duration-700 group-hover:scale-110" />
                            </div>
                            <div class="mt-4 flex justify-between items-start px-2">
                                <div>
                                    <h3
                                        class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-rose-600 transition-colors uppercase">
                                        Structured Blazer</h3>
                                    <p class="text-xs text-gray-500 mt-1 uppercase tracking-widest">Tailored Fit</p>
                                </div>
                                <p class="text-sm font-black text-gray-900 dark:text-white">$185.00</p>
                            </div>
                        </a>
                    </li>
                    <li class="group">
                        <a href="#" class="block">
                            <div class="relative overflow-hidden rounded-3xl aspect-3/4 bg-gray-100 dark:bg-gray-800">
                                <img src="{{ asset('assets/img/clothes/Button-up Shirt.jpg') }}" alt=""
                                    class="h-full w-full object-cover transition duration-700 group-hover:scale-110" />
                            </div>
                            <div class="mt-4 flex justify-between items-start px-2">
                                <div>
                                    <h3
                                        class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-rose-600 transition-colors uppercase">
                                        Structured Blazer</h3>
                                    <p class="text-xs text-gray-500 mt-1 uppercase tracking-widest">Tailored Fit</p>
                                </div>
                                <p class="text-sm font-black text-gray-900 dark:text-white">$185.00</p>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="mb-24">
                <div class="group relative h-87.5 overflow-hidden rounded-4xl shadow-2xl transition-all duration-500">
                    <img src="{{ asset('assets/img/accessories/Tote Bag.jpg') }}" alt="Accessories"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105">
                    <div
                        class="absolute inset-0 bg-linear-to-l from-black/80 via-black/40 to-transparent flex items-center justify-end">
                        <div class="max-w-xl px-12 text-right">
                            <h3 class="text-4xl font-black text-white uppercase italic tracking-widest">Accessories
                            </h3>
                            <p class="mt-4 text-gray-300 text-lg">The finishing touch that defines your character.</p>
                            <a href="#"
                                class="mt-8 inline-flex flex-row-reverse items-center px-8 py-3 bg-rose-600 text-white text-sm font-bold uppercase tracking-widest rounded-full hover:bg-rose-700 transition-all group/btn">
                                Explore All
                                <svg class="w-5 h-5 mr-2 transition-transform group-hover/btn:-translate-x-2 rotate-180"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <ul class="grid grid-cols-2 gap-6 mt-12 lg:grid-cols-4">
                    <li class="group">
                        <a href="#" class="block">
                            <div class="relative overflow-hidden rounded-3xl aspect-3/4 bg-gray-100 dark:bg-gray-800">
                                <img src="{{ asset('assets/img/accessories/Bucket Hat.jpg') }}" alt="Classic Watch"
                                    class="h-full w-full object-cover transition duration-700 group-hover:scale-110" />
                            </div>
                            <div class="mt-4 flex justify-between items-start px-2">
                                <div>
                                    <h3
                                        class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-rose-600 transition-colors uppercase">
                                        Classic Chronograph</h3>
                                    <p class="text-xs text-gray-500 mt-1 uppercase tracking-widest">Premium Leather</p>
                                </div>
                                <p class="text-sm font-black text-gray-900 dark:text-white">$245.00</p>
                            </div>
                        </a>
                    </li>

                    <li class="group">
                        <a href="#" class="block">
                            <div class="relative overflow-hidden rounded-3xl aspect-3/4 bg-gray-100 dark:bg-gray-800">
                                <img src="{{ asset('assets/img/accessories/Sunglasses.jpg') }}" alt="Sunglasses"
                                    class="h-full w-full object-cover transition duration-700 group-hover:scale-110" />
                            </div>
                            <div class="mt-4 flex justify-between items-start px-2">
                                <div>
                                    <h3
                                        class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-rose-600 transition-colors uppercase">
                                        Aviator Noir</h3>
                                    <p class="text-xs text-gray-500 mt-1 uppercase tracking-widest">UV Protection</p>
                                </div>
                                <p class="text-sm font-black text-gray-900 dark:text-white">$120.00</p>
                            </div>
                        </a>
                    </li>

                    <li class="group">
                        <a href="#" class="block">
                            <div class="relative overflow-hidden rounded-3xl aspect-3/4 bg-gray-100 dark:bg-gray-800">
                                <img src="{{ asset('assets/img/accessories/Cuff Bracelet.jpg') }}" alt="Leather Bag"
                                    class="h-full w-full object-cover transition duration-700 group-hover:scale-110" />
                            </div>
                            <div class="mt-4 flex justify-between items-start px-2">
                                <div>
                                    <h3
                                        class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-rose-600 transition-colors uppercase">
                                        Mini Suede Tote</h3>
                                    <p class="text-xs text-gray-500 mt-1 uppercase tracking-widest">Handcrafted</p>
                                </div>
                                <p class="text-sm font-black text-gray-900 dark:text-white">$310.00</p>
                            </div>
                        </a>
                    </li>

                    <li class="group">
                        <a href="#" class="block">
                            <div class="relative overflow-hidden rounded-3xl aspect-3/4 bg-gray-100 dark:bg-gray-800">
                                <img src="{{ asset('assets/img/accessories/Layered Necklace.jpg') }}" alt="Necklace"
                                    class="h-full w-full object-cover transition duration-700 group-hover:scale-110" />
                            </div>
                            <div class="mt-4 flex justify-between items-start px-2">
                                <div>
                                    <h3
                                        class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-rose-600 transition-colors uppercase">
                                        Aura Gold Chain</h3>
                                    <p class="text-xs text-gray-500 mt-1 uppercase tracking-widest">18k Plated</p>
                                </div>
                                <p class="text-sm font-black text-gray-900 dark:text-white">$155.00</p>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="border-t border-gray-100 dark:border-gray-800 pt-10"></div>
        </div>
    </section>
    <!-- ==================
        NEW_COLLECTION-end
    ====================== -->



    <!-- ==================
        CONTACT
    ====================== -->
    <section id="contact" class="relative pt-24 bg-rose-50 dark:bg-gray-950 overflow-hidden">
        <div class="absolute top-0 right-0 -translate-y-12 translate-x-12 blur-3xl opacity-20 pointer-events-none">
            <div class="aspect-square w-96 rounded-full bg-rose-400"></div>
        </div>

        <div class="container px-6 mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-xs font-black tracking-[0.4em] text-rose-500 uppercase mb-4">Visit Our Studio</h2>
                <h1 class="text-4xl font-black text-gray-900 lg:text-5xl dark:text-white uppercase tracking-tighter">
                    Get In <span class="text-rose-600">Touch</span>
                </h1>
                <div class="w-20 h-1 bg-rose-600 mx-auto mt-6 rounded-full"></div>
            </div>

            <div class="flex flex-wrap lg:flex-nowrap gap-12 pb-24">
                <div
                    class="relative w-full lg:w-2/3 min-h-125 rounded-[2.5rem] overflow-hidden shadow-2xl bg-gray-200 group">
                    <iframe width="100%" height="100%"
                        class="absolute inset-0 grayscale contrast-125 opacity-80 group-hover:grayscale-0 transition-all duration-700"
                        frameborder="0" title="FashionAura Studio Map"
                        src="https://maps.google.com/maps?q=Jakarta&t=&z=13&ie=UTF8&iwloc=&output=embed">
                    </iframe>

                    <div
                        class="relative m-6 md:m-10 p-8 bg-white/90 dark:bg-gray-900/90 backdrop-blur-xl rounded-3xl shadow-xl max-w-md mt-auto">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <h3 class="text-2xs font-black tracking-widest text-rose-600 uppercase mb-2">The
                                    Studio</h3>
                                <p class="text-sm text-gray-700 dark:text-gray-300 font-medium leading-relaxed">
                                    Grand Boutique St. No. 12<br>
                                    Menteng, Central Jakarta<br>
                                    Indonesia 10310
                                </p>
                            </div>
                            <div>
                                <h3 class="text-2xs font-black tracking-widest text-rose-600 uppercase mb-2">Connect
                                </h3>
                                <a href="mailto:hello@fashionaura.com"
                                    class="block text-sm font-bold text-gray-900 dark:text-white hover:text-rose-600">hello@fashionaura.com</a>
                                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400 font-medium">+62 21 555 0123
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-1/3 flex flex-col justify-center">
                    <div
                        class="bg-white dark:bg-gray-900 p-10 rounded-[2.5rem] shadow-xl border border-rose-100 dark:border-gray-800">
                        <h3 class="text-2xl font-black text-gray-900 dark:text-white mb-2 uppercase italic">Send a
                            Message</h3>
                        <p class="text-sm text-gray-500 mb-8">We usually respond within 24 hours.</p>

                        <form action="#" class="space-y-5">
                            <div class="relative">
                                <input type="text" id="name" placeholder="Full Name"
                                    class="w-full px-5 py-4 text-sm bg-gray-50 dark:bg-gray-800 border-none rounded-2xl focus:ring-2 focus:ring-rose-500 transition-all outline-none text-gray-900 dark:text-white">
                            </div>
                            <div class="relative">
                                <input type="email" id="email" placeholder="Email Address"
                                    class="w-full px-5 py-4 text-sm bg-gray-50 dark:bg-gray-800 border-none rounded-2xl focus:ring-2 focus:ring-rose-500 transition-all outline-none text-gray-900 dark:text-white">
                            </div>
                            <div class="relative">
                                <textarea id="message" rows="4" placeholder="Your Message"
                                    class="w-full px-5 py-4 text-sm bg-gray-50 dark:bg-gray-800 border-none rounded-2xl focus:ring-2 focus:ring-rose-500 transition-all outline-none text-gray-900 dark:text-white resize-none"></textarea>
                            </div>
                            <button
                                class="w-full py-4 bg-gray-900 dark:bg-rose-600 text-white font-bold uppercase tracking-widest text-xs rounded-2xl hover:bg-rose-600 dark:hover:bg-rose-700 transform active:scale-95 transition-all shadow-lg shadow-rose-200 dark:shadow-none">
                                Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="border-t border-rose-200 dark:border-gray-800 py-12">
                <div class="flex flex-wrap items-center justify-between gap-10">
                    <div class="flex items-center space-x-6">
                        <div
                            class="w-12 h-12 rounded-full bg-rose-100 dark:bg-rose-900/30 flex items-center justify-center text-rose-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-black uppercase text-gray-900 dark:text-white tracking-widest">
                                Opening Hours</h4>
                            <p class="text-gray-500 dark:text-gray-400 text-sm">Mon - Sun: 08:00 AM - 10:00 PM</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <span class="text-xs font-black uppercase tracking-widest text-gray-400">Follow Our
                            Journey:</span>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-white dark:bg-gray-800 shadow-md flex items-center justify-center text-gray-600 dark:text-gray-300 hover:bg-rose-600 hover:text-white transition-all transform hover:-translate-y-1">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-white dark:bg-gray-800 shadow-md flex items-center justify-center text-gray-600 dark:text-gray-300 hover:bg-rose-600 hover:text-white transition-all transform hover:-translate-y-1">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-white dark:bg-gray-800 shadow-md flex items-center justify-center text-gray-600 dark:text-gray-300 hover:bg-rose-600 hover:text-white transition-all transform hover:-translate-y-1">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==================
        CONTACT-end
    ====================== -->



    <!-- ==================
        FOOTER
    ====================== -->
    <footer class="bg-white lg:grid lg:grid-cols-5 dark:bg-gray-900">
        <div class="relative block h-32 p-20 lg:col-span-2 lg:h-full">
            <img src="https://images.unsplash.com/photo-1642370324100-324b21fab3a9?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1548&q=80"
                alt="" class="absolute inset-0 object-cover w-full h-full" />
        </div>

        <div class="px-4 py-16 sm:px-6 lg:col-span-3 lg:px-8">
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2">
                <div>
                    <p>
                        <span class="text-xs tracking-wide text-gray-500 uppercase dark:text-gray-400">
                            Call us
                        </span>

                        <a href="#"
                            class="block text-2xl font-medium text-gray-900 hover:opacity-75 sm:text-3xl dark:text-white">
                            0123456789
                        </a>
                    </p>

                    <ul class="mt-8 space-y-1 text-sm text-gray-700 dark:text-gray-200">
                        <li>Monday to Friday: 10am - 5pm</li>
                        <li>Weekend: 10am - 3pm</li>
                    </ul>

                    <ul class="flex gap-6 mt-8">
                        <li>
                            <a href="#" rel="noreferrer" target="_blank"
                                class="text-gray-700 transition hover:opacity-75 dark:text-gray-200">
                                <span class="sr-only">Facebook</span>

                                <svg class="size-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>

                        <li>
                            <a href="#" rel="noreferrer" target="_blank"
                                class="text-gray-700 transition hover:opacity-75 dark:text-gray-200">
                                <span class="sr-only">Instagram</span>

                                <svg class="size-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>

                        <li>
                            <a href="#" rel="noreferrer" target="_blank"
                                class="text-gray-700 transition hover:opacity-75 dark:text-gray-200">
                                <span class="sr-only">Twitter</span>

                                <svg class="size-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path
                                        d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                                </svg>
                            </a>
                        </li>

                        <li>
                            <a href="#" rel="noreferrer" target="_blank"
                                class="text-gray-700 transition hover:opacity-75 dark:text-gray-200">
                                <span class="sr-only">GitHub</span>

                                <svg class="size-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>

                        <li>
                            <a href="#" rel="noreferrer" target="_blank"
                                class="text-gray-700 transition hover:opacity-75 dark:text-gray-200">
                                <span class="sr-only">Dribbble</span>

                                <svg class="size-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c5.51 0 10-4.48 10-10S17.51 2 12 2zm6.605 4.61a8.502 8.502 0 011.93 5.314c-.281-.054-3.101-.629-5.943-.271-.065-.141-.12-.293-.184-.445a25.416 25.416 0 00-.564-1.236c3.145-1.28 4.577-3.124 4.761-3.362zM12 3.475c2.17 0 4.154.813 5.662 2.148-.152.216-1.443 1.941-4.48 3.08-1.399-2.57-2.95-4.675-3.189-5A8.687 8.687 0 0112 3.475zm-3.633.803a53.896 53.896 0 013.167 4.935c-3.992 1.063-7.517 1.04-7.896 1.04a8.581 8.581 0 014.729-5.975zM3.453 12.01v-.26c.37.01 4.512.065 8.775-1.215.25.477.477.965.694 1.453-.109.033-.228.065-.336.098-4.404 1.42-6.747 5.303-6.942 5.629a8.522 8.522 0 01-2.19-5.705zM12 20.547a8.482 8.482 0 01-5.239-1.8c.152-.315 1.888-3.656 6.703-5.337.022-.01.033-.01.054-.022a35.318 35.318 0 011.823 6.475 8.4 8.4 0 01-3.341.684zm4.761-1.465c-.086-.52-.542-3.015-1.659-6.084 2.679-.423 5.022.271 5.314.369a8.468 8.468 0 01-3.655 5.715z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <p class="font-medium text-gray-900 dark:text-white">Services</p>

                        <ul class="mt-6 space-y-4 text-sm">
                            <li>
                                <a href="#"
                                    class="text-gray-700 transition hover:opacity-75 dark:text-gray-200">
                                    1on1 Coaching
                                </a>
                            </li>

                            <li>
                                <a href="#"
                                    class="text-gray-700 transition hover:opacity-75 dark:text-gray-200">
                                    Company Review
                                </a>
                            </li>

                            <li>
                                <a href="#"
                                    class="text-gray-700 transition hover:opacity-75 dark:text-gray-200">
                                    Accounts Review
                                </a>
                            </li>

                            <li>
                                <a href="#"
                                    class="text-gray-700 transition hover:opacity-75 dark:text-gray-200">
                                    HR Consulting
                                </a>
                            </li>

                            <li>
                                <a href="#"
                                    class="text-gray-700 transition hover:opacity-75 dark:text-gray-200">
                                    SEO Optimisation
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <p class="font-medium text-gray-900 dark:text-white">Company</p>

                        <ul class="mt-6 space-y-4 text-sm">
                            <li>
                                <a href="#"
                                    class="text-gray-700 transition hover:opacity-75 dark:text-gray-200">
                                    About
                                </a>
                            </li>

                            <li>
                                <a href="#"
                                    class="text-gray-700 transition hover:opacity-75 dark:text-gray-200">
                                    Meet the Team
                                </a>
                            </li>

                            <li>
                                <a href="#"
                                    class="text-gray-700 transition hover:opacity-75 dark:text-gray-200">
                                    Accounts Review
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="pt-12 mt-12 border-t border-gray-100 dark:border-gray-800">
                <div class="sm:flex sm:items-center sm:justify-between">
                    <ul class="flex flex-wrap gap-4 text-xs">
                        <li>
                            <a href="#" class="text-gray-500 transition hover:opacity-75 dark:text-gray-400">
                                Terms & Conditions
                            </a>
                        </li>

                        <li>
                            <a href="#" class="text-gray-500 transition hover:opacity-75 dark:text-gray-400">
                                Privacy Policy
                            </a>
                        </li>

                        <li>
                            <a href="#" class="text-gray-500 transition hover:opacity-75 dark:text-gray-400">
                                Cookies
                            </a>
                        </li>
                    </ul>

                    <p class="mt-8 text-xs text-gray-500 sm:mt-0 dark:text-gray-400">
                        &copy; 2022. Company Name. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- ==================
        FOOTER-end
    ====================== -->







    <!-- MyScript -->
    <button id="back-to-top" aria-label="Back to top"
        class="hidden fixed bottom-8 right-8 w-14 h-14 rounded-2xl bg-white dark:bg-gray-900 text-rose-600 shadow-[0_10px_30px_rgba(225,29,72,0.2)] dark:shadow-none border border-rose-100 dark:border-gray-800 z-50 transition-all duration-500 hover:bg-rose-600 hover:text-white hover:-translate-y-2 group items-center justify-center">

        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
            stroke="currentColor" class="w-6 h-6 transition-transform duration-500 group-hover:-translate-y-1">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
        </svg>

        <span class="absolute inset-0 rounded-2xl bg-rose-600 opacity-0 group-hover:animate-ping -z-10"></span>
    </button>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const header = document.getElementById('site-header') || document.querySelector('header');
            const backToTop = document.getElementById('back-to-top');

            // Active Navigation Handler
            const navLinks = document.querySelectorAll('.nav-link');
            const sections = document.querySelectorAll('section[id]');

            function removeActiveNav() {
                navLinks.forEach(link => {
                    link.classList.remove('text-rose-600');
                    link.classList.add('hover:text-rose-600', 'group');
                    const span = link.querySelector('span');
                    if (span) {
                        span.classList.remove('w-8');
                        span.classList.add('w-0');
                    }
                });
            }

            function setActiveNav(sectionId) {
                removeActiveNav();
                const activeLink = document.querySelector(`.nav-link[data-nav="${sectionId}"]`);
                if (activeLink) {
                    activeLink.classList.remove('hover:text-rose-600', 'group');
                    activeLink.classList.add('text-rose-600');
                    const span = activeLink.querySelector('span');
                    if (span) {
                        span.classList.remove('w-0');
                        span.classList.add('w-8');
                    }
                }
            }

            // Intersection Observer for active section detection
            const observerOptions = {
                root: null,
                rootMargin: '-50% 0px -50% 0px',
                threshold: 0
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        setActiveNav(entry.target.id);
                    }
                });
            }, observerOptions);

            sections.forEach(section => {
                observer.observe(section);
            });

            window.addEventListener('scroll', () => {
                if (window.scrollY > 300) {
                    backToTop.classList.remove('hidden');
                    backToTop.classList.add('flex');
                } else {
                    backToTop.classList.add('hidden');
                    backToTop.classList.remove('flex');
                }
            });

            window.addEventListener('scroll', () => {
                const header = document.getElementById('site-header');
                const container = document.getElementById('header-container');
                if (window.scrollY > 50) {
                    header.classList.add('bg-white/80', 'dark:bg-gray-950/80', 'backdrop-blur-md',
                        'shadow-sm');
                    container.classList.remove('lg:py-6');
                    container.classList.add('lg:py-3');
                } else {
                    header.classList.remove('bg-white/80', 'dark:bg-gray-950/80', 'backdrop-blur-md',
                        'shadow-sm');
                    container.classList.remove('lg:py-3');
                    container.classList.add('lg:py-6');
                }
            });

            backToTop.addEventListener('click', () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            function onScroll() {
                if (!header) return;

                if (window.pageYOffset > 10) {
                    header.classList.add('shadow-md', 'bg-white', 'dark:bg-gray-900');
                } else {
                    header.classList.remove('shadow-md', 'bg-white', 'dark:bg-gray-900');
                }

                if (backToTop) {
                    if (window.pageYOffset > 300) backToTop.classList.remove('hidden');
                    else backToTop.classList.add('hidden');
                }
            }

            window.addEventListener('scroll', onScroll, {
                passive: true
            });
            onScroll();

            if (backToTop) {
                backToTop.addEventListener('click', function() {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            }
        });
    </script>
    <!-- MyScript-end -->
</body>

</html>
