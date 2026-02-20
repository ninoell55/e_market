<div class="min-h-screen font-sans tracking-tight" x-data="{
    sidebarOpen: false,
    isMinimized: localStorage.getItem('sidebar-minimized') === 'true',
    darkMode: document.documentElement.classList.contains('dark')
}" x-init="$watch('darkMode', val => {
    if (val) {
        document.documentElement.classList.add('dark');
        localStorage.setItem('dark-mode', 'true');
    } else {
        document.documentElement.classList.remove('dark');
        localStorage.setItem('dark-mode', 'false');
    }
});

$watch('isMinimized', val => {
    localStorage.setItem('sidebar-minimized', val);
})">
    <div
        class="flex min-h-screen bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-gray-100 transition-colors duration-300">

        <aside
            :class="{
                'w-72': !isMinimized,
                'w-20': isMinimized,
                '-translate-x-full': !sidebarOpen,
                'translate-x-0': sidebarOpen
            }"
            class="fixed lg:sticky top-0 left-0 h-screen bg-white dark:bg-gray-900 border-r border-gray-100 dark:border-gray-800 transition-all duration-300 z-50 flex flex-col lg:translate-x-0">

            <div
                class="flex items-center h-20 px-6 border-b border-gray-50 dark:border-gray-800 overflow-hidden shrink-0">
                <div class="flex items-center gap-3">
                    <div
                        class="w-8 h-8 bg-gray-900 dark:bg-rose-600 rounded-lg flex items-center justify-center shadow-sm shrink-0">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <a href="{{ route(Auth::user()->getDashboardRouteName()) }}" class="group">
                        <span x-show="!isMinimized" x-transition.opacity
                            class="text-lg font-black tracking-tighter text-gray-900 dark:text-white uppercase transition-colors group-hover:text-rose-600">
                            Aura<span class="italic font-light">Admin</span>
                        </span>
                    </a>
                </div>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto overflow-x-hidden">
                <x-sidebar-link :href="route(Auth::user()->getDashboardRouteName())" :active="request()->routeIs(Auth::user()->getDashboardRouteName())">
                    <x-slot name="icon">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 11v-5m0 0V9m0 5h.01" />
                        </svg>
                    </x-slot>
                    <span x-show="!isMinimized" x-transition.opacity>{{ __('Dashboard') }}</span>
                </x-sidebar-link>

                <div class="pt-6 pb-2 px-6">
                    <p x-show="!isMinimized" class="text-2xs font-black text-gray-400 uppercase tracking-[0.2em]">
                        Management</p>
                    <hr x-show="isMinimized" class="border-red-500" />
                </div>

                <div class="space-y-1">
                    {{-- 1. Gunakan komponen dropdown untuk menu induk --}}
                    <x-sidebar-dropdown label="Catalog" :active="request()->routeIs('admin.product.*') || request()->routeIs('admin.category.*')">
                        <x-slot name="icon">
                            {{-- Masukkan SVG asli kamu di sini --}}
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </x-slot>

                        {{-- 2. Gunakan komponen sublink untuk menu di dalamnya --}}
                        <x-sidebar-sublink :href="route('admin.product.index')" :active="request()->routeIs('admin.product.*')">
                            Products
                        </x-sidebar-sublink>

                        <x-sidebar-sublink :href="route('admin.category.index')" :active="request()->routeIs('admin.category.*')">
                            Categories
                        </x-sidebar-sublink>
                    </x-sidebar-dropdown>
                </div>

                <a href="#"
                    class="flex items-center h-11 rounded-xl text-gray-500 hover:bg-gray-50 dark:hover:bg-gray-800 transition-all group">
                    <div class="w-12 shrink-0 flex items-center justify-center group-hover:text-rose-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <span x-show="!isMinimized" x-transition.opacity
                        class="text-sm font-bold uppercase tracking-widest flex-1 leading-none group-hover:text-gray-900 dark:group-hover:text-white">Orders</span>
                </a>

                <div class="pt-6 pb-2 px-6">
                    <p x-show="!isMinimized" class="text-2xs font-black text-gray-400 uppercase tracking-[0.2em]">Config</p>
                    <hr x-show="isMinimized" class="border-red-500" />
                </div>

                <a href="#"
                    class="flex items-center h-11 rounded-xl text-gray-500 hover:bg-gray-50 dark:hover:bg-gray-800 transition-all group">
                    <div class="w-12 shrink-0 flex items-center justify-center group-hover:text-rose-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        </svg>
                    </div>
                    <span x-show="!isMinimized" x-transition.opacity
                        class="text-sm font-bold uppercase tracking-widest flex-1 leading-none group-hover:text-gray-900 dark:group-hover:text-white">Settings</span>
                </a>
            </nav>

            <div class="p-4 mt-auto border-t border-gray-50 dark:border-gray-800">
                <div x-show="!isMinimized" x-transition.opacity
                    class="bg-gray-900 dark:bg-rose-900/10 border border-white/5 p-5 rounded-2xl">
                    <p class="text-2xs font-black text-rose-500 uppercase tracking-widest">Aura Cloud v1.0</p>
                    <p class="text-2xs text-gray-400 mt-1 uppercase tracking-tighter leading-tight">The system is
                        running optimally.</p>
                </div>

                <div x-show="isMinimized" x-transition.opacity class="flex justify-center py-2">
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse shadow-[0_0_8px_rgba(34,197,94,0.6)]">
                    </div>
                </div>
            </div>
        </aside>

        <div x-show="sidebarOpen" @click="sidebarOpen = false"
            class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm z-40 lg:hidden"
            x-transition:enter="transition opacity-0 duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition opacity-100 duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        </div>

        <div class="flex-1 flex flex-col min-w-0">
            <header
                class="sticky top-0 z-40 h-20 bg-white/80 dark:bg-gray-950/80 backdrop-blur-xl border-b border-gray-50 dark:border-gray-900 flex items-center justify-between px-4 sm:px-8">
                <div class="flex items-center gap-4 sm:gap-6">
                    <button @click="window.innerWidth < 1024 ? sidebarOpen = !sidebarOpen : isMinimized = !isMinimized"
                        class="text-gray-400 hover:text-rose-600 dark:hover:text-rose-500 transition-colors duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!isMinimized" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1.5" d="M4 6h16M4 12h16M4 18h7" />
                            <path x-show="isMinimized" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1.5" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                        </svg>
                    </button>
                    <nav class="hidden md:block">
                        <p class="text-2xs font-black text-gray-400 dark:text-gray-500 uppercase tracking-[0.3em]">
                            <span class="font-inter">Management</span> / {{ Breadcrumbs::render() }}
                        </p>
                    </nav>
                </div>

                <div class="flex items-center gap-3 sm:gap-6">
                    <div
                        class="pr-6 border-r border-gray-200 dark:border-gray-800 text-2xs font-black text-gray-400 uppercase tracking-[0.2em]">
                        {{ now()->format('D, d M Y') }}
                    </div>

                    <button @click="darkMode = !darkMode"
                        class="rounded-xl text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900 hover:text-rose-600 dark:hover:text-rose-500 transition-all duration-200 border border-transparent">
                        <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                    </button>

                    <x-dropdown align="right" width="56">
                        <x-slot name="trigger">
                            <div
                                class="flex items-center gap-3 sm:gap-4 sm:pl-6 sm:border-l border-gray-100 dark:border-gray-800 cursor-pointer group select-none">
                                <div class="text-right flex flex-col justify-center">
                                    <p
                                        class="text-2xs sm:text-xs font-black text-gray-900 dark:text-white uppercase tracking-tighter leading-tight group-hover:text-rose-600 transition-colors">
                                        {{ Auth::user()->name }}
                                    </p>
                                    <p
                                        class="text-[8px] sm:text-[9px] text-rose-600 font-bold uppercase tracking-widest leading-none mt-0.5">
                                        {{ ucfirst(Auth::user()->role) }}
                                    </p>
                                </div>

                                <div class="relative shrink-0 transition-transform active:scale-95 duration-200">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=111827&color=fff"
                                        class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl shadow-sm border border-transparent group-hover:border-rose-600 transition-all duration-300"
                                        alt="Avatar" />
                                    <div
                                        class="absolute -bottom-0.5 -right-0.5 w-2.5 h-2.5 bg-green-500 border-2 border-white dark:border-gray-950 rounded-full">
                                    </div>
                                </div>
                            </div>
                        </x-slot>

                        <x-slot name="content">
                            <div
                                class="px-4 py-3 bg-gray-50/50 dark:bg-gray-900/50 border-b border-gray-100 dark:border-gray-800">
                                <p class="text-[9px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-0.5">Account
                                    Info</p>
                                <p class="text-[11px] font-black text-gray-900 dark:text-white truncate uppercase">
                                    {{ Auth::user()->email }}</p>
                            </div>

                            <div class="p-1.5">
                                <x-dropdown-link :href="route('profile.edit')"
                                    class="rounded-lg text-2xs font-bold uppercase tracking-widest text-gray-600 dark:text-gray-400 hover:text-gray-600 transition-all">
                                    {{ __('Edit Profile') }}
                                </x-dropdown-link>

                                <div class="my-1.5 border-t border-gray-50 dark:border-gray-800"></div>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="rounded-lg text-2xs font-bold uppercase tracking-widest text-rose-600 transition-all">
                                        {{ __('Sign Out') }}
                                    </x-dropdown-link>
                                </form>
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>
            </header>

            <main>
                @yield('main')
            </main>
        </div>
    </div>
</div>
