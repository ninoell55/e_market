<nav x-data="{
    open: false,
    darkMode: document.documentElement.classList.contains('dark')
}" x-init="$watch('darkMode', val => {
    if (val) {
        document.documentElement.classList.add('dark');
        localStorage.setItem('dark-mode', 'true');
    } else {
        document.documentElement.classList.remove('dark');
        localStorage.setItem('dark-mode', 'false');
    }
});"
    class="sticky top-0 z-50 bg-white dark:bg-gray-950 border-b border-gray-100 dark:border-white/5">
    <div class="w-full">
        <div class="flex justify-between h-24">
            <div class="flex">
                <div class="shrink-0 flex items-center px-6 lg:px-12 border-r border-gray-100 dark:border-white/5">
                    <a href="{{ route(Auth::user()->getDashboardRouteName()) }}"
                        class="group transition-transform active:scale-95">
                        <x-application-logo
                            class="block h-10 w-auto fill-current text-gray-900 dark:text-white group-hover:text-rose-600 transition-colors" />
                    </a>
                </div>

                <div class="hidden sm:flex">
                    <x-nav-link :href="route(Auth::user()->getDashboardRouteName())" :active="request()->routeIs(Auth::user()->getDashboardRouteName())">
                        {{ __('Index') }}
                    </x-nav-link>

                    <div class="flex">
                        <x-dropdown align="left" width="64">
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-8 h-full border-r border-gray-100 dark:border-white/5 text-[11px] font-black uppercase tracking-[0.4em] transition-all outline-none group {{ request()->routeIs('member.collection.show') ? 'text-rose-600 bg-gray-50/50 dark:bg-white/2 shadow-[inset_0_-2px_0_0_#e11d48]' : 'text-gray-400 hover:text-gray-950 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-white/5' }}">

                                    <span>Collections</span>

                                    <svg class="ml-2 w-3 h-3 transition-transform duration-300 {{ request()->routeIs('member.collection.show') ? 'text-rose-600' : '' }}"
                                        :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <div
                                    class="bg-white dark:bg-gray-950 border border-gray-100 dark:border-white/10 rounded-none shadow-2xl overflow-hidden">
                                    <div
                                        class="p-4 border-b border-gray-100 dark:border-white/5 bg-gray-50/50 dark:bg-white/2 text-center">
                                        <p
                                            class="text-[9px] font-black text-rose-600 uppercase tracking-[0.3em] italic">
                                            Archive // Categories</p>
                                    </div>

                                    @foreach ($categories as $category)
                                        @php
                                            // Check if this specific category is active in the current URL
                                            $isCatActive = request()->route('slug') === $category->slug;
                                        @endphp

                                        <x-dropdown-link :href="route('member.collection.show', $category->slug)"
                                            class="px-6 py-4 text-2xs font-black uppercase tracking-widest transition-all {{ $isCatActive ? 'bg-rose-600 text-white hover:text-black' : 'hover:bg-rose-600 hover:text-white text-gray-700 dark:text-gray-300' }}">
                                            <div class="flex justify-between items-center">
                                                <span>{{ $category->category_name }}</span>
                                                <span
                                                    class="{{ $isCatActive ? 'text-white/50' : 'opacity-30' }} italic">
                                                    // {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                                </span>
                                            </div>
                                        </x-dropdown-link>
                                    @endforeach

                                    <div
                                        class="p-4 border-t border-gray-100 dark:border-white/5 text-center bg-gray-50/30 dark:bg-white/1">
                                        <a href="{{ route(Auth::user()->getDashboardRouteName()) }}"
                                            class="text-[9px] font-bold text-gray-400 hover:text-rose-600 uppercase tracking-tighter transition-colors">
                                            Back to Global Feed →
                                        </a>
                                    </div>
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>

                    <x-nav-link :href="route('member.archive')" :active="request()->routeIs('member.archive')">
                        {{ __('Archive') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="flex items-center">
                <div
                    class="hidden xl:flex h-full items-center px-10 border-l border-gray-100 dark:border-white/5 text-2xs font-black text-gray-400 uppercase tracking-[0.3em] italic">
                    {{ now()->format('D, d M Y') }}
                </div>

                <button @click="darkMode = !darkMode"
                    class="h-full px-8 border-l border-gray-100 dark:border-white/5 text-gray-400 hover:text-rose-600 hover:bg-gray-50 dark:hover:bg-white/5 transition-all focus:outline-none cursor-pointer">
                    <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>

                <div class="h-full sm:flex sm:items-center">
                    <x-dropdown align="right" width="64">
                        <x-slot name="trigger">
                            <div
                                class="h-24 flex items-center gap-6 px-6 lg:px-12 border-l border-gray-100 dark:border-white/5 bg-gray-50/50 dark:bg-white/2 cursor-pointer group select-none hover:bg-rose-600 transition-all duration-500">
                                <div class="hidden md:flex text-right flex-col justify-center">
                                    <p
                                        class="text-xs font-black text-gray-900 dark:text-white uppercase tracking-tighter group-hover:text-white transition-colors">
                                        {{ Auth::user()->name }}
                                    </p>
                                    <p
                                        class="text-[9px] text-rose-600 font-bold uppercase tracking-[0.2em] mt-1 group-hover:text-rose-200 transition-colors">
                                        {{ ucfirst(Auth::user()->role) }}
                                    </p>
                                </div>
                                <div class="relative shrink-0">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=111827&color=fff"
                                        class="w-10 h-10 rounded-none border border-gray-900 dark:border-white group-hover:border-white transition-all duration-300 object-cover grayscale group-hover:grayscale-0"
                                        alt="Avatar" />
                                </div>
                            </div>
                        </x-slot>

                        <x-slot name="content">
                            <div
                                class="px-5 py-4 bg-white dark:bg-gray-950 border-b border-gray-100 dark:border-white/5">
                                <p class="text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-1">Status:
                                    Active</p>
                                <p
                                    class="text-xs font-black text-gray-900 dark:text-white italic lowercase tracking-tight">
                                    {{ Auth::user()->email }}</p>
                            </div>
                            <div class="p-2 bg-white dark:bg-gray-950">
                                <x-dropdown-link :href="route('profile.edit')"
                                    class="rounded-none text-2xs font-black uppercase tracking-[0.2em] hover:bg-rose-600 hover:text-white transition-all">
                                    Profile
                                </x-dropdown-link>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                        class="rounded-none text-2xs font-black uppercase tracking-[0.2em] text-rose-600 hover:bg-rose-600 hover:text-white transition-all"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        Sign Out
                                    </x-dropdown-link>
                                </form>
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>

                <div class="flex items-center sm:hidden h-full border-l border-gray-100 dark:border-white/5">
                    <button @click="open = ! open"
                        class="px-6 h-full text-gray-500 hover:bg-gray-100 dark:hover:bg-white/5 transition-all">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16" />
                            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div x-show="open" class="sm:hidden bg-white dark:bg-gray-950 border-t border-gray-100 dark:border-white/5">
        <div class="py-4 space-y-1">
            <x-responsive-nav-link :href="route(Auth::user()->getDashboardRouteName())" :active="request()->routeIs(Auth::user()->getDashboardRouteName())"
                class="font-black uppercase tracking-[0.3em] text-xs">
                Dashboard
            </x-responsive-nav-link>
            <x-responsive-nav-link href="#" class="font-black uppercase tracking-[0.3em] text-xs">
                Collections
            </x-responsive-nav-link>
        </div>
    </div>
</nav>
