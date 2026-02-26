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
    <style>
        body:has(#hamburger:checked) {
            overflow: hidden;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="selection:bg-rose-600">

    @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif


    <!-- ==================
        NAVBAR
    ====================== -->
    <header id="site-header" class="fixed top-0 left-0 w-full z-999 transition-all duration-300 bg-transparent">
        <div class="relative z-20 py-4">
            <div class="px-6 md:px-12 w-full xl:px-14 lg:py-4 transition-all duration-300" id="header-container">
                <div class="flex items-center justify-between">
                    <div class="relative z-20">
                        <a class="flex items-center gap-2 text-3xl font-extrabold text-gray-900 dark:text-white transition-transform duration-300 hover:scale-105"
                            href="#">
                            <span class="-tracking-widest">Fashion<span class="text-rose-600 italic">Aura</span></span>
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
                                        class="flex flex-col lg:flex-row items-center gap-4 px-10 py-12 border-t border-rose-500 dark:border-white/10 lg:border-t-0 lg:border-l lg:py-0 lg:pr-0 lg:pl-10 lg:ml-4">

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
    {{-- <div class="h-20 bg-white dark:bg-gray-900"></div> --}}



    <!-- ==================
        HERO
    ====================== -->
    <section id="home"
        class="dark relative min-h-screen overflow-hidden bg-gray-950 flex items-center py-20 mt-15">

        <div class="absolute inset-0 overflow-hidden pointer-events-none -z-10">
            <div class="absolute -left-24 top-1/2 -translate-y-1/2 rotate-90 origin-center opacity-[0.05] select-none">
                <h2 class="text-[20rem] font-black uppercase tracking-tighter text-white whitespace-nowrap">AURA STUDIO
                </h2>
            </div>
            <div
                class="absolute -right-24 top-1/2 -translate-y-1/2 -rotate-90 origin-center opacity-[0.05] select-none">
                <h2 class="text-[20rem] font-black uppercase tracking-tighter text-white whitespace-nowrap">COLLECTION
                </h2>
            </div>

            <div
                class="absolute top-0 left-0 w-[60vw] h-[60vw] bg-rose-900/20 rounded-full blur-[120px] -translate-x-1/4 -translate-y-1/4">
            </div>
            <div
                class="absolute bottom-0 right-0 w-[50vw] h-[50vw] bg-blue-900/10 rounded-full blur-[120px] translate-x-1/4 translate-y-1/4">
            </div>
        </div>

        <div class="w-full px-6 lg:px-16 xl:px-24 mx-auto max-w-500 relative z-10">
            <div class="grid grid-cols-1 gap-16 lg:grid-cols-12 lg:items-center">

                <div class="lg:col-span-5 order-2 lg:order-1">
                    <div class="space-y-12">
                        <div class="inline-flex items-center space-x-4">
                            <span class="w-16 h-0.5 bg-rose-600"></span>
                            <span class="text-sm font-black tracking-[0.5em] text-rose-600 uppercase">Premium
                                Boutique</span>
                        </div>

                        <h1
                            class="text-7xl font-black tracking-tighter text-white xl:text-[9rem] leading-[0.82] uppercase">
                            Elevate Your <br>
                            <span class="text-rose-600 italic">Daily Aura.</span>
                        </h1>

                        <p class="text-xl leading-relaxed text-gray-400 max-w-xl font-medium">
                            Experience the perfect blend of comfort and high-fashion. Our 2026 collection brings you
                            curated essentials designed to redefine your personal style.
                        </p>

                        <div class="flex flex-col space-y-4 sm:flex-row sm:space-y-0 sm:space-x-8 pt-4">
                            <a href="#produk"
                                class="group relative inline-flex items-center justify-center px-12 py-5 text-xs font-black tracking-[0.3em] text-white uppercase transition-all duration-500 bg-rose-600 rounded-full overflow-hidden shadow-[0_20px_50px_rgba(225,29,72,0.4)]">
                                <span class="relative z-10">Shop Collection</span>
                                <div
                                    class="absolute inset-0 bg-white transition-transform duration-500 translate-y-full group-hover:translate-y-0">
                                </div>
                                <span
                                    class="absolute inset-0 bg-white transition-transform duration-500 translate-y-full group-hover:translate-y-0"></span>
                                <div
                                    class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-20 text-black">
                                    Shop Collection
                                </div>
                            </a>
                            <a href="#tentang"
                                class="flex items-center justify-center px-12 py-5 text-xs font-black tracking-[0.3em] text-white uppercase transition-all duration-500 border-2 border-white/10 rounded-full hover:border-rose-600 hover:text-rose-600 hover:bg-rose-600/5">
                                Our Story
                            </a>
                        </div>

                        <div class="pt-12 flex items-center gap-16 border-t border-white/5">
                            <div class="group">
                                <p
                                    class="text-5xl font-black text-white group-hover:text-rose-600 transition-all duration-300">
                                    99%</p>
                                <p class="text-2xs uppercase tracking-[0.4em] text-gray-500 font-bold mt-2">
                                    Satisfaction</p>
                            </div>
                            <div class="w-px h-16 bg-white/10"></div>
                            <div class="group">
                                <p
                                    class="text-5xl font-black text-white group-hover:text-rose-600 transition-all duration-300">
                                    24h</p>
                                <p class="text-2xs uppercase tracking-[0.4em] text-gray-500 font-bold mt-2">Shipping
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-7 order-1 lg:order-2">
                    <div class="relative grid grid-cols-12 gap-6 lg:gap-10 transform lg:scale-110 lg:translate-x-10">

                        <div
                            class="group col-span-8 overflow-hidden rounded-[4rem] shadow-[0_50px_100px_-20px_rgba(0,0,0,0.5)] aspect-4/5 relative border border-white/5">
                            <img class="absolute inset-0 object-cover w-full h-full transition-all duration-[2s] grayscale group-hover:grayscale-0 scale-110 group-hover:scale-100"
                                src="{{ asset('assets/img/shoes-hero.jpg') }}" alt="Main Fashion Look">

                            <div
                                class="absolute inset-0 bg-gray-950/60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500 backdrop-blur-sm">
                                <p class="text-white text-2xl font-black uppercase tracking-[0.3em]">View Shoes</p>
                            </div>

                            <div
                                class="absolute inset-0 bg-linear-to-t from-gray-950/40 via-transparent to-transparent pointer-events-none">
                            </div>
                        </div>

                        <div class="col-span-4 flex flex-col gap-6 lg:gap-10">
                            <div
                                class="group overflow-hidden rounded-[3rem] shadow-2xl relative border border-white/5">
                                <img class="w-full h-full transition-all duration-[2s] grayscale group-hover:grayscale-0 scale-110 group-hover:scale-100"
                                    src="{{ asset('assets/img/clothes-hero.jpg') }}" alt="Clothes">

                                <div
                                    class="absolute inset-0 bg-gray-950/60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500 backdrop-blur-sm">
                                    <p class="text-white text-lg font-black uppercase tracking-[0.3em]">View Clothes
                                    </p>
                                </div>

                                <div
                                    class="absolute inset-0 bg-linear-to-t from-gray-950/40 via-transparent to-transparent pointer-events-none">
                                </div>
                            </div>

                            <div
                                class="group overflow-hidden rounded-[3rem] shadow-2xl relative border border-white/5">
                                <img class="w-full h-full transition-all duration-[2s] grayscale group-hover:grayscale-0 scale-110 group-hover:scale-100"
                                    src="{{ asset('assets/img/accessories-hero.jpg') }}" alt="Accessories">

                                <div
                                    class="absolute inset-0 bg-gray-950/60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500 backdrop-blur-sm">
                                    <p class="text-white text-lg font-black uppercase tracking-[0.3em]">View
                                        Accessories</p>
                                </div>

                                <div
                                    class="absolute inset-0 bg-linear-to-t from-gray-950/40 via-transparent to-transparent pointer-events-none">
                                </div>
                            </div>
                        </div>

                        <div
                            class="absolute -bottom-12 -left-12 -z-10 w-64 h-64 bg-rose-600/10 rounded-full blur-[100px]">
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
    <section class="relative bg-white overflow-hidden py-0">
        <div class="w-full flex flex-col lg:flex-row min-h-[80vh] items-stretch">

            <div class="w-full lg:w-1/2 relative flex items-center bg-gray-50/50">
                <div class="absolute top-10 left-0 select-none pointer-events-none opacity-[0.04]">
                    <h2 class="text-[18rem] font-black leading-none uppercase -translate-x-20">AURA</h2>
                </div>

                <div class="relative z-10 px-8 py-20 md:px-20 lg:pl-24 xl:pl-32 flex flex-col justify-center">
                    <div class="space-y-10">
                        <div class="inline-flex items-center gap-4">
                            <span
                                class="px-4 py-1.5 text-2xs font-black tracking-[0.4em] text-white uppercase bg-rose-600 rounded-full shadow-lg shadow-rose-600/20">
                                New Era
                            </span>
                            <div class="h-px w-24 bg-rose-600/20"></div>
                        </div>

                        <h2
                            class="text-6xl font-black leading-[0.85] tracking-tighter text-gray-950 md:text-8xl xl:text-[7rem] uppercase">
                            This is <br>
                            <span
                                class="text-transparent bg-clip-text bg-linear-to-r from-rose-600 to-rose-400 italic">
                                Fashion Aura.
                            </span>
                        </h2>

                        <p class="max-w-xl text-xl font-medium text-gray-600 leading-relaxed">
                            Join the revolution of style. We don't just sell clothes; we provide the confidence to
                            redefine who you are in every single thread.
                        </p>

                        <div class="flex flex-wrap gap-6 pt-6">
                            <a href="#tentang"
                                class="group relative px-10 py-5 overflow-hidden rounded-full bg-gray-950 text-white font-black tracking-[0.2em] text-xs transition-all duration-500 hover:shadow-[0_20px_40px_-10px_rgba(0,0,0,0.3)]">
                                <span class="relative z-10">LEARN OUR STORY</span>
                                <div
                                    class="absolute inset-0 bg-rose-600 translate-y-full group-hover:translate-y-0 transition-transform duration-500">
                                </div>
                            </a>
                            <a href="https://wa.me/yournumber"
                                class="px-10 py-5 text-xs font-black tracking-[0.2em] text-gray-950 uppercase border-2 border-gray-200 rounded-full hover:border-rose-600 hover:text-rose-600 transition-all duration-300">
                                Get In Touch
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/2 relative min-h-125 lg:min-h-full group overflow-hidden">
                <img src="{{ asset('assets/img/second-hero.jpg') }}"
                    class="absolute inset-0 object-cover w-full h-full transition-all duration-[2s] grayscale group-hover:grayscale-0 scale-110 group-hover:scale-100"
                    alt="Style Statement">

                <div
                    class="absolute inset-0 flex items-center justify-center p-8 bg-black/10 group-hover:bg-black/0 transition-all duration-700">
                    <div
                        class="relative p-12 backdrop-blur-xl bg-white/10 border border-white/20 rounded-[3rem] shadow-2xl transform transition-all duration-700 group-hover:-translate-y-6">
                        <h3 class="text-5xl font-black uppercase text-white leading-tight">
                            Fashion.<br>
                            <span class="text-rose-500 italic">Aura.</span><br>
                            Global.
                        </h3>
                        <div class="w-20 h-2 bg-rose-500 mt-8 mb-6 rounded-full"></div>
                        <p class="text-xs font-black tracking-[0.3em] text-white/90 uppercase italic">
                            "Your look, your statement."
                        </p>

                        <div
                            class="absolute -top-8 -right-8 w-24 h-24 bg-white rounded-full flex items-center justify-center shadow-[0_20px_40px_rgba(0,0,0,0.2)] rotate-12 group-hover:rotate-0 transition-all duration-500">
                            <span class="text-rose-600 font-black text-sm text-center leading-tight">EST<br>2026</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full bg-gray-950 border-y border-white/5 py-12 overflow-hidden flex">

            <div class="flex whitespace-nowrap animate-marquee">

                <div class="flex items-center gap-20 pr-20">
                    <span
                        class="text-4xl md:text-5xl font-black tracking-[0.5em] text-white/10 uppercase hover:text-rose-600 transition-colors cursor-default">AUTHENTIC</span>
                    <div class="w-3 h-3 rounded-full bg-rose-600 shadow-[0_0_15px_rgba(225,29,72,0.4)]"></div>

                    <span
                        class="text-4xl md:text-5xl font-black tracking-[0.5em] text-white/10 uppercase hover:text-rose-600 transition-colors cursor-default">MODERN</span>
                    <div class="w-3 h-3 rounded-full bg-rose-600 shadow-[0_0_15px_rgba(225,29,72,0.4)]"></div>

                    <span
                        class="text-4xl md:text-5xl font-black tracking-[0.5em] text-white/10 uppercase hover:text-rose-600 transition-colors cursor-default">STYLISH</span>
                    <div class="w-3 h-3 rounded-full bg-rose-600 shadow-[0_0_15px_rgba(225,29,72,0.4)]"></div>
                </div>

                <div class="flex items-center gap-20 pr-20">
                    <span
                        class="text-4xl md:text-5xl font-black tracking-[0.5em] text-white/10 uppercase hover:text-rose-600 transition-colors cursor-default">AUTHENTIC</span>
                    <div class="w-3 h-3 rounded-full bg-rose-600 shadow-[0_0_15px_rgba(225,29,72,0.4)]"></div>

                    <span
                        class="text-4xl md:text-5xl font-black tracking-[0.5em] text-white/10 uppercase hover:text-rose-600 transition-colors cursor-default">MODERN</span>
                    <div class="w-3 h-3 rounded-full bg-rose-600 shadow-[0_0_15px_rgba(225,29,72,0.4)]"></div>

                    <span
                        class="text-4xl md:text-5xl font-black tracking-[0.5em] text-white/10 uppercase hover:text-rose-600 transition-colors cursor-default">STYLISH</span>
                    <div class="w-3 h-3 rounded-full bg-rose-600 shadow-[0_0_15px_rgba(225,29,72,0.4)]"></div>
                </div>

            </div>
        </div>
    </section>


    <!-- ==================
        second_HERO-end
    ====================== -->



    <!-- ==================
        WHY
    ====================== -->
    <section id="tentang"
        class="relative bg-gray-955 dark:bg-gray-950 overflow-hidden py-24 lg:py-0 font-inter min-h-screen flex items-center">

        <div class="absolute inset-0 pointer-events-none -z-10">
            <div class="absolute -right-20 top-1/2 -translate-y-1/2 rotate-90 origin-center opacity-3 select-none">
                <h2 class="text-[18rem] font-black uppercase tracking-tighter text-white whitespace-nowrap">HANDCRAFTED
                </h2>
            </div>
            <div class="absolute top-1/4 left-0 w-96 h-96 bg-rose-600/10 rounded-full blur-[120px]"></div>
        </div>

        <div class="w-full flex flex-col lg:flex-row items-stretch gap-0">

            <div class="w-full lg:w-[45%] relative">
                <div class="h-full min-h-150 lg:min-h-screen relative group overflow-hidden">
                    <img src="{{ asset('assets/img/about.jpg') }}"
                        class="absolute inset-0 w-full h-full object-cover transition-all duration-[2s] grayscale group-hover:grayscale-0 scale-110 group-hover:scale-100"
                        alt="The Craftsmanship of FashionAura">

                    <div class="absolute inset-0 bg-linear-to-r from-gray-950/20 to-transparent"></div>

                    <div
                        class="absolute bottom-12 left-12 lg:left-20 bg-rose-600 p-10 rounded-[2.5rem] text-white shadow-[0_30px_60px_-15px_rgba(225,29,72,0.5)] max-w-[320px] transform transition-all duration-700 group-hover:-translate-y-4">
                        <h4 class="text-3xl font-black mb-3 italic tracking-tighter">Vision 2026</h4>
                        <p class="text-xs leading-relaxed font-bold tracking-widest opacity-90 uppercase">
                            "Setting a new global standard for local luxury in every thread."
                        </p>
                        <div class="mt-6 w-16 h-1.5 bg-white/40 rounded-full"></div>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-[55%] bg-gray-950 flex items-center py-20 lg:py-0">
                <div class="px-8 md:px-16 lg:px-24 xl:px-32 space-y-20 w-full">

                    <div class="space-y-8">
                        <div class="inline-flex items-center gap-6 mt-6">
                            <span class="h-0.5 w-16 bg-rose-600"></span>
                            <span class="text-xs font-black tracking-[0.6em] text-rose-600 uppercase">Legacy &
                                Excellence</span>
                        </div>

                        <h2
                            class="text-6xl md:text-8xl font-black text-white leading-[0.85] tracking-[ -0.05em] uppercase">
                            Defining The <br> <span class="text-rose-600 italic">Aura of Style.</span>
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 pt-6">
                            <p class="text-xl text-gray-400 leading-relaxed font-medium">
                                Founded on the principle of rebellious elegance, <span
                                    class="text-white font-black underline decoration-rose-600 underline-offset-8">FashionAura</span>
                                emerged to
                                challenge the status quo. We believe that true luxury isn't just about a label.
                            </p>
                            <p class="text-xl text-gray-400 leading-relaxed border-l-4 border-white/5 pl-10 italic">
                                Every stitch is a commitment. Every silhouette is a story. We fuse the world’s finest
                                materials with the untamed spirit of Indonesian artisans.
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-16 gap-y-16">

                        <div class="relative group">
                            <div
                                class="absolute -top-10 -left-6 text-8xl font-black text-white/3 group-hover:text-rose-600/10 transition-colors duration-500 select-none">
                                01</div>
                            <div class="relative space-y-4">
                                <h3 class="text-xl font-black text-white uppercase tracking-wider">Uncompromising
                                    Quality</h3>
                                <p class="text-gray-500 leading-relaxed text-base font-medium">
                                    Premium textiles sourced directly. From high-grade cotton to sustainable leather, we
                                    ensure your statement lasts.
                                </p>
                            </div>
                        </div>

                        <div class="relative group">
                            <div
                                class="absolute -top-10 -left-6 text-8xl font-black text-white/3 group-hover:text-rose-600/10 transition-colors duration-500 select-none">
                                02</div>
                            <div class="relative space-y-4">
                                <h3 class="text-xl font-black text-white uppercase tracking-wider">Ethical Empowerment
                                </h3>
                                <p class="text-gray-500 leading-relaxed text-base font-medium">
                                    A fair-trade ecosystem ensuring your style contributes to the prosperity of local
                                    creative communities.
                                </p>
                            </div>
                        </div>

                        <div class="relative group">
                            <div
                                class="absolute -top-10 -left-6 text-8xl font-black text-white/3 group-hover:text-rose-600/10 transition-colors duration-500 select-none">
                                03</div>
                            <div class="relative space-y-4">
                                <h3 class="text-xl font-black text-white uppercase tracking-wider">Modern Minimalism
                                </h3>
                                <p class="text-gray-500 leading-relaxed text-base font-medium">
                                    Design lab monitoring global shifts in Milan and Tokyo, translating them into
                                    versatile pieces.
                                </p>
                            </div>
                        </div>

                        <div class="relative group">
                            <div
                                class="absolute -top-10 -left-6 text-8xl font-black text-white/3 group-hover:text-rose-600/10 transition-colors duration-500 select-none">
                                04</div>
                            <div class="relative space-y-4">
                                <h3 class="text-xl font-black text-white uppercase tracking-wider">Authentic Guarantee
                                </h3>
                                <p class="text-gray-500 leading-relaxed text-base font-medium">
                                    Each masterpiece comes with a unique serial number, guaranteeing Indonesian
                                    heritage.
                                </p>
                            </div>
                        </div>

                    </div>

                    <div
                        class="pt-16 border-t border-white/5 flex flex-col md:flex-row md:items-center justify-between gap-8 mb-8">
                        <p class="text-2xs font-black tracking-[0.5em] uppercase text-gray-600 mb-2">Our
                            Signature</p>
                        <h4 class="text-3xl font-serif italic text-white/70">FashionAura — Quality over quantity,
                            always.</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==================
        WHY-end
    ====================== -->



    <!-- ==================
        BLOG
    ====================== -->
    <section id="layanan" class="bg-gray-950 w-full overflow-hidden">
        <div class="flex flex-col lg:flex-row w-full min-h-screen">

            <div class="relative w-full lg:w-1/2 h-[80vh] lg:h-screen group overflow-hidden">
                <img class="absolute inset-0 w-full h-full object-cover transition-transform duration-2000 group-hover:scale-110"
                    src="{{ asset('assets/img/shoes-collection.jpg') }}" alt="Premium Shoes">

                <div
                    class="absolute inset-0 bg-linear-to-t from-black via-black/20 to-transparent opacity-80 group-hover:opacity-90 transition-opacity duration-700">
                </div>

                <div class="absolute inset-0 flex flex-col justify-end p-10 lg:p-20">
                    <div
                        class="mb-6 transform translate-y-10 group-hover:translate-y-0 transition-transform duration-700">
                        <span class="text-rose-500 font-black tracking-[0.5em] uppercase text-xs">Flagship
                            Category</span>
                        <h2
                            class="text-7xl lg:text-[9vw] font-black text-white uppercase leading-[0.8] tracking-tighter mt-4">
                            Sho<span class="text-rose-600">es.</span>
                        </h2>
                    </div>

                    <div
                        class="max-w-md opacity-0 group-hover:opacity-100 transition-all duration-1000 delay-100 transform translate-y-4 group-hover:translate-y-0">
                        <p class="text-gray-300 text-lg font-medium leading-relaxed mb-8">
                            The foundation of your style. Engineered for the bold, crafted for the streets, and designed
                            to leave a legacy.
                        </p>
                        <a href="#" class="inline-flex items-center group/btn">
                            <span
                                class="px-8 py-4 bg-white text-black text-xs font-black uppercase tracking-widest group-hover/btn:bg-rose-600 group-hover/btn:text-white transition-all">Shop
                                Shoes</span>
                            <span
                                class="p-4 bg-rose-600 text-white transition-transform group-hover/btn:translate-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/2 flex flex-col">

                <div
                    class="relative h-[50vh] lg:h-1/2 group overflow-hidden border-b border-white/10 lg:border-l lg:border-white/10">
                    <img class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110"
                        src="{{ asset('assets/img/clothes-collection.jpg') }}" alt="Clothes">
                    <div class="absolute inset-0 bg-black/40 group-hover:bg-black/60 transition-colors duration-500">
                    </div>

                    <div class="absolute inset-0 flex items-center justify-between p-12">
                        <div class="max-w-xs">
                            <h3 class="text-4xl lg:text-6xl font-black text-white uppercase tracking-tighter">Clothes
                            </h3>
                            <p class="text-gray-400 text-sm mt-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                Modern silhouettes for urban daily life.</p>
                        </div>
                        <a href="#"
                            class="w-16 h-16 rounded-full border border-white/20 flex items-center justify-center text-white hover:bg-white hover:text-black transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="relative h-[50vh] lg:h-1/2 group overflow-hidden lg:border-l lg:border-white/10">
                    <img class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110"
                        src="{{ asset('assets/img/accessories-collection.jpg') }}" alt="Accessories">
                    <div class="absolute inset-0 bg-black/40 group-hover:bg-black/60 transition-colors duration-500">
                    </div>

                    <div class="absolute inset-0 flex items-center justify-between p-12">
                        <div class="max-w-xs">
                            <h3 class="text-4xl lg:text-6xl font-black text-white uppercase tracking-tighter">
                                Accessories
                            </h3>
                            <p class="text-gray-400 text-sm mt-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                The final touch for your signature look.</p>
                        </div>
                        <a href="#"
                            class="w-16 h-16 rounded-full border border-white/20 flex items-center justify-center text-white hover:bg-white hover:text-black transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
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
    <section id="produk" class="bg-white dark:bg-gray-950 overflow-hidden">
        <header class="w-full bg-gray-950 px-6 lg:px-12 text-center py-20">

            <div class="inline-flex items-center space-x-6 mb-8">
                <span class="w-2 h-2 bg-rose-600 rotate-45 shadow-[0_0_10px_rgba(225,29,72,0.5)]"></span>
                <span class="text-2xs md:text-xs font-black text-gray-500 uppercase tracking-[0.6em]">
                    Curated Collection
                </span>
                <span class="w-2 h-2 bg-rose-600 rotate-45 shadow-[0_0_10px_rgba(225,29,72,0.5)]"></span>
            </div>

            <h2 class="text-7xl md:text-9xl font-black text-white uppercase tracking-tighter">
                THE <span class="text-rose-600 italic">EDITS</span>
            </h2>

            <div class="mt-10 flex justify-center items-center gap-4">
                <div class="h-px w-20 bg-linear-to-r from-transparent to-white/10"></div>
                <div class="text-2xs font-bold text-gray-600 uppercase tracking-widest">Aura Selection 2026</div>
                <div class="h-px w-20 bg-linear-to-l from-transparent to-white/10"></div>
            </div>

        </header>

        <div class="group">
            <div class="flex flex-col lg:flex-row items-stretch min-h-150">
                <div class="relative w-full lg:w-2/5 overflow-hidden">
                    <img src="{{ asset('assets/img/shoes.jpg') }}" alt="Shoes"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105">
                    <div
                        class="absolute inset-0 bg-linear-to-t from-black via-black/20 to-transparent lg:bg-linear-to-r lg:from-black lg:to-transparent flex items-end lg:items-center p-12">
                        <div class="max-w-md">
                            <h3
                                class="text-6xl font-black text-white uppercase italic tracking-tighter leading-none mb-4">
                                Shoes</h3>
                            <p class="text-gray-300 text-lg mb-8">Engineered for comfort, designed for the streets.</p>
                            <a href="#"
                                class="inline-block border-b-2 border-rose-600 pb-2 text-white font-black uppercase tracking-widest hover:text-rose-600 transition-colors">Shoes
                                Collection →</a>
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-3/5 bg-gray-50 dark:bg-gray-900/50 p-8 lg:p-12 flex items-center">
                    <div class="grid grid-cols-2 gap-4 md:gap-8 w-full">
                        @forelse ($shoes->products as $product)
                            <a href="#"
                                class="group/item relative bg-white dark:bg-gray-950 p-4 rounded-3xl shadow-xs hover:shadow-2xl transition-all duration-500">
                                <div class="relative overflow-hidden rounded-2xl aspect-square mb-4">
                                    <img src="{{ asset('storage/uploads/' . $product->image) }}"
                                        class="w-full h-full object-cover group-hover/item:scale-110 transition-transform duration-700">
                                </div>
                                <h4 class="text-xs font-black uppercase dark:text-white">{{ $product->name }}</h4>
                                <p class="text-rose-600 font-bold">IDR
                                    {{ number_format($product->price, 0, ',', '.') }}</p>
                            </a>
                        @empty
                            <div class="col-span-2 text-center py-10">
                                <p class="text-gray-400 italic">Shoes collection is coming soon.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="group bg-gray-950">
            <div class="flex flex-col lg:flex-row-reverse items-stretch min-h-175">
                <div class="relative w-full lg:w-1/2 overflow-hidden">
                    <img src="{{ asset('assets/img/clothes.jpg') }}" alt="Clothes"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-[2s] group-hover:scale-110 grayscale-50 group-hover:grayscale-0">
                    <div
                        class="absolute inset-0 bg-linear-to-t from-gray-950 via-gray-950/20 to-transparent lg:bg-linear-to-l lg:from-gray-950 lg:via-gray-950/40 lg:to-transparent flex items-end lg:items-center p-12 lg:p-24 justify-end">
                        <div class="max-w-md text-right relative z-10">
                            <h3
                                class="text-7xl font-black text-white uppercase italic tracking-tighter mb-6 leading-none">
                                Clothes</h3>
                            <p class="text-gray-400 text-xl mb-10 font-medium">From essential basics to statement
                                pieces.</p>
                            <a href="#"
                                class="group/btn inline-flex items-center gap-4 text-white font-black uppercase tracking-[0.3em] text-sm transition-all">
                                <span
                                    class="border-b-2 border-rose-600 pb-2 group-hover/btn:text-rose-600 transition-colors">Clothes
                                    Collection</span>
                                <span
                                    class="text-2xl transition-transform group-hover/btn:translate-x-3 text-rose-600">→</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div
                    class="w-full lg:w-1/2 bg-gray-950 p-6 lg:p-16 xl:p-24 flex items-center border-y lg:border-y-0 lg:border-l border-white/5">
                    <div class="grid grid-cols-2 gap-6 lg:gap-10 w-full">
                        @forelse ($clothes->products as $product)
                            <a href="#"
                                class="group/item relative bg-white/5 backdrop-blur-sm p-6 rounded-[2.5rem] border border-white/5 hover:bg-white/10 hover:border-rose-600/30 transition-all duration-700 hover:-translate-y-3">
                                <div class="relative overflow-hidden rounded-[1.8rem] aspect-square mb-6">
                                    <img src="{{ asset('storage/uploads/' . $product->image) }}"
                                        class="w-full h-full object-cover transition-all duration-1000 scale-100 group-hover/item:scale-110">
                                </div>
                                <div class="space-y-1">
                                    <h4 class="text-sm font-black uppercase text-white tracking-widest">
                                        {{ $product->name }}</h4>
                                    <p class="text-rose-500 font-black text-lg">IDR
                                        {{ number_format($product->price, 0, ',', '.') }}</p>
                                </div>
                            </a>
                        @empty
                            <div class="col-span-2 text-center py-10">
                                <p class="text-gray-500 italic">No clothes available at the moment.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="group">
            <div class="flex flex-col lg:flex-row items-stretch min-h-150">
                <div class="relative w-full lg:w-2/5 overflow-hidden">
                    <img src="{{ asset('assets/img/accessories.jpg') }}" alt="Accessories"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105">
                    <div
                        class="absolute inset-0 bg-linear-to-t from-black via-black/20 to-transparent lg:bg-linear-to-r lg:from-black lg:to-transparent flex items-end lg:items-center p-12">
                        <div class="max-w-md">
                            <h3
                                class="text-6xl font-black text-white uppercase italic tracking-tighter leading-none mb-4">
                                Accessories</h3>
                            <p class="text-gray-300 text-lg mb-8">The finishing touch that defines your unique
                                character and style.</p>
                            <a href="#"
                                class="inline-block border-b-2 border-rose-600 pb-2 text-white font-black uppercase tracking-widest hover:text-rose-600 transition-colors">Accessories
                                Collection →</a>
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-3/5 bg-gray-50 dark:bg-gray-900/50 p-8 lg:p-12 flex items-center">
                    <div class="grid grid-cols-2 gap-4 md:gap-8 w-full">
                        @forelse ($accessories->products as $product)
                            <a href="#"
                                class="group/item relative bg-white dark:bg-gray-950 p-4 rounded-3xl shadow-xs hover:shadow-2xl transition-all duration-500">
                                <div class="relative overflow-hidden rounded-2xl aspect-square mb-4">
                                    <img src="{{ asset('storage/uploads/' . $product->image) }}"
                                        class="w-full h-full object-cover group-hover/item:scale-110 transition-transform duration-700">
                                </div>
                                <h4 class="text-xs font-black uppercase dark:text-white">{{ $product->name }}</h4>
                                <p class="text-rose-600 font-bold">IDR
                                    {{ number_format($product->price, 0, ',', '.') }}</p>
                            </a>
                        @empty
                            <div class="col-span-2 text-center py-10">
                                <p class="text-gray-400 italic">Check back later for new accessories!</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==================
        NEW_COLLECTION-end
    ====================== -->



    <!-- ==================
        CONTACT
    ====================== -->
    <section id="contact" class="relative bg-gray-950 py-0 overflow-hidden font-inter">
        <div class="absolute top-10 left-0 select-none pointer-events-none opacity-[0.02] whitespace-nowrap z-0">
            <h2 class="text-[25rem] font-black leading-none uppercase tracking-tighter">Contact</h2>
        </div>

        <div class="w-full flex flex-col lg:flex-row min-h-screen items-stretch relative z-10">

            <div
                class="w-full lg:w-2/5 flex flex-col justify-between py-24 px-8 md:px-16 lg:pl-20 xl:pl-32 bg-gray-950 border-r border-white/5">
                <div>
                    <span class="inline-flex items-center gap-4 mb-12">
                        <span class="w-8 h-px bg-rose-600"></span>
                        <span class="text-rose-600 text-2xs font-black uppercase tracking-[0.5em]">Get In
                            Touch</span>
                    </span>

                    <h1
                        class="text-7xl md:text-8xl xl:text-8xl font-black text-white uppercase tracking-tighter leading-[0.8] mb-16">
                        LET'S <br>
                        <span class="text-rose-600 italic">CONNECT.</span>
                    </h1>

                    <div class="space-y-16">
                        <div class="group">
                            <h3
                                class="text-xs font-black uppercase tracking-[0.3em] text-gray-500 mb-6 group-hover:text-rose-600 transition-colors">
                                The Flagship Studio</h3>
                            <p
                                class="text-2xl md:text-3xl font-medium text-gray-200 leading-tight tracking-tight max-w-md">
                                Grand Boutique St. No. 12,<br>
                                Menteng, Central Jakarta 10310
                            </p>
                        </div>

                        <div class="group">
                            <h3
                                class="text-xs font-black uppercase tracking-[0.3em] text-gray-500 mb-6 group-hover:text-rose-600 transition-colors">
                                Email Inquiry</h3>
                            <a href="mailto:hello@fashionaura.com"
                                class="text-2xl md:text-3xl font-black text-white hover:text-rose-600 transition-all underline decoration-rose-600/30 decoration-4 underline-offset-12 hover:underline-offset-16">
                                hello@fashionaura.com
                            </a>
                        </div>
                    </div>
                </div>

                <div class="mt-24 grid grid-cols-2 gap-8 border-t border-white/10 pt-12">
                    <div>
                        <h4 class="text-2xs font-black uppercase tracking-[0.4em] text-gray-500 mb-6">Follow Us</h4>
                        <div class="flex space-x-6 text-xl text-white">
                            <a href="#"
                                class="hover:text-rose-600 transform hover:-translate-y-1 transition-all"><i
                                    class="fab fa-instagram"></i></a>
                            <a href="#"
                                class="hover:text-rose-600 transform hover:-translate-y-1 transition-all"><i
                                    class="fab fa-tiktok"></i></a>
                            <a href="#"
                                class="hover:text-rose-600 transform hover:-translate-y-1 transition-all"><i
                                    class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-2xs font-black uppercase tracking-[0.4em] text-gray-500 mb-6">Studio Hours
                        </h4>
                        <p class="text-[11px] font-black text-white uppercase leading-relaxed tracking-widest">
                            Mon — Sun<br>
                            <span class="text-rose-600">08:00 — 22:00</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-3/5 relative min-h-125 lg:min-h-full group">
                <div
                    class="absolute inset-0 grayscale contrast-125 brightness-50 group-hover:grayscale-0 group-hover:brightness-100 transition-all duration-[1.5s]">
                    <iframe width="100%" height="100%" frameborder="0" style="border:0;"
                        src="https://maps.google.com/maps?q=Menteng%20Jakarta&t=&z=13&ie=UTF8&iwloc=&output=embed"
                        allowfullscreen></iframe>
                </div>

                <div class="absolute inset-0 pointer-events-none flex flex-col justify-between p-12 lg:p-20">
                    <div class="self-end pointer-events-auto">
                        <div class="bg-gray-950/80 backdrop-blur-xl p-8 rounded-4xl border border-white/10 shadow-2xl">
                            <p class="text-2xs font-black uppercase tracking-[0.3em] text-rose-600 mb-2">Location
                                Status</p>
                            <div class="flex items-center gap-3">
                                <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                                <p class="text-sm font-bold text-white uppercase tracking-widest">Open Until 10:00 PM
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="max-w-xl pointer-events-auto">
                        <h2
                            class="text-5xl lg:text-7xl font-black text-white leading-[0.9] uppercase tracking-tighter">
                            Find us in the <br>
                            heart of the <br>
                            <span class="text-transparent" style="-webkit-text-stroke: 1px white;">fashion
                                capital.</span>
                        </h2>
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
    <x-footer />
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
