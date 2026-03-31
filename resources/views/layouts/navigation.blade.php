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
                <div class="shrink-0 flex items-center px-6 lg:px-12 lg:border-r border-gray-100 dark:border-white/5">
                    <a href="{{ route(Auth::user()->getDashboardRouteName()) }}"
                        class="group transition-all active:scale-95">
                        <span
                            class="text-xl font-black tracking-tighter text-gray-900 dark:text-white uppercase transition-all duration-500 group-hover:tracking-widest">
                            FASHION<span class="text-rose-600 italic">AURA</span>
                        </span>
                    </a>
                </div>

                <div class="hidden lg:flex">
                    <x-nav-link :href="route(Auth::user()->getDashboardRouteName())" :active="request()->routeIs(Auth::user()->getDashboardRouteName())">
                        {{ __('Index') }}
                    </x-nav-link>

                    <div class="flex">
                        <x-dropdown align="left" width="64">
                            <x-slot name="trigger">
                                <button
                                    class="cursor-pointer inline-flex items-center px-8 h-full border-r border-gray-100 dark:border-white/5 text-[11px] font-black uppercase tracking-[0.4em] transition-all outline-none group {{ request()->routeIs('member.collection') ? 'text-rose-600 bg-gray-50/50 dark:bg-white/2 shadow-[inset_0_-2px_0_0_#e11d48]' : 'text-gray-400 hover:text-gray-950 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-white/5' }}">

                                    <span>Collections</span>

                                    <svg class="ml-2 w-3 h-3 transition-transform duration-300 {{ request()->routeIs('member.collection') ? 'text-rose-600' : '' }}"
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
                                    @foreach ($categories as $category)
                                        @php
                                            // Check if this specific category is active in the current URL
                                            $isCatActive = request()->route('slug') === $category->slug;
                                        @endphp

                                        <x-dropdown-link :href="route('member.collection', $category->slug)"
                                            class="px-6 py-4 text-2xs font-black uppercase tracking-widest transition-all {{ $isCatActive ? 'bg-rose-600 hover:bg-rose-700 text-white' : 'hover:bg-gray-200 text-gray-700 dark:text-gray-300' }}">
                                            <div class="flex justify-between items-center">
                                                <span>{{ $category->category_name }}</span>
                                                <span
                                                    class="{{ $isCatActive ? 'text-white/50' : 'opacity-30' }} italic">
                                                    // {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                                </span>
                                            </div>
                                        </x-dropdown-link>
                                    @endforeach
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>

                    <x-nav-link :href="route('member.archive.addresses')" :active="request()->routeIs('member.archive.*')">
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
                    class="h-full px-8 lg:border-l border-gray-100 dark:border-white/5 text-gray-400 hover:text-rose-600 hover:bg-gray-50 dark:hover:bg-white/5 transition-all focus:outline-none cursor-pointer">
                    <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>

                <div class="hidden lg:flex items-center">
                    @php
                        $cartCount = Auth::check() ? Auth::user()->cart?->items?->count() ?? 0 : 0;
                        $displayCount = str_pad($cartCount, 2, '0', STR_PAD_LEFT);
                        $cartRoute = route('member.cart.index');
                    @endphp
                    <a href="{{ $cartRoute }}"
                        class="relative p-3 text-gray-400 hover:text-gray-950 dark:hover:text-white transition-all group border-l border-gray-100 dark:border-white/5 h-20 flex items-center justify-center px-8">
                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>

                        @if ($cartCount > 0)
                            <span
                                class="absolute top-6 right-6 flex items-center justify-center min-w-4.5 h-4.5 bg-gray-950 dark:bg-white text-[9px] font-black text-white dark:text-gray-950 group-hover:bg-rose-600 group-hover:text-white transition-colors">
                                {{ $displayCount }}
                            </span>
                        @endif
                    </a>
                    <div class="border-r border-gray-100 dark:border-white/5 h-20"></div>
                </div>

                <div class="h-full hidden lg:flex sm:items-center">
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
                                        class="confirm-delete-btn rounded-none text-2xs font-black uppercase tracking-[0.2em] text-rose-600 hover:bg-rose-600 hover:text-white transition-all"
                                        data-confirm-title="Ready to Sign Out?"
                                        data-confirm-text="You will need to login again to manage your luxury collection."
                                        data-confirm-button="SIGN OUT" onclick="event.preventDefault();">
                                        {{ __('Sign Out') }}
                                    </x-dropdown-link>
                                </form>
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>

                <div class="flex items-center lg:hidden h-full lg:border-l border-gray-100 dark:border-white/5">
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

    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4"
        class="lg:hidden bg-white dark:bg-gray-950 border-t border-gray-100 dark:border-white/5 shadow-2xl overflow-hidden">

        <div class="flex flex-col divide-y divide-gray-100 dark:divide-white/5">
            {{-- Index Link --}}
            <a href="{{ route(Auth::user()->getDashboardRouteName()) }}"
                class="group relative px-8 py-6 text-[11px] font-black uppercase tracking-[0.4em] transition-all duration-300 flex items-center
                {{ request()->routeIs(Auth::user()->getDashboardRouteName()) ? 'text-rose-600 bg-gray-50/50 dark:bg-white/2' : 'text-gray-400 hover:text-rose-600 hover:pl-10 hover:bg-gray-50/30 dark:hover:bg-white/1' }}">
                <span
                    class="absolute left-0 top-0 w-1 h-full bg-rose-600 scale-y-0 group-hover:scale-y-100 transition-transform duration-300 origin-center"></span>
                {{ __('Index') }}
            </a>

            {{-- Collections Dropdown --}}
            <div x-data="{ mobOpen: false }" class="relative">
                <button @click="mobOpen = !mobOpen"
                    class="group w-full flex justify-between items-center px-8 py-6 text-[11px] font-black uppercase tracking-[0.4em] transition-all duration-300
                    {{ request()->routeIs('member.collection') ? 'text-rose-600' : 'text-gray-400 hover:text-rose-600 hover:bg-gray-50/30 dark:hover:bg-white/1' }}">
                    <span
                        class="absolute left-0 top-0 w-1 h-full bg-rose-600 scale-y-0 group-hover:scale-y-100 transition-transform duration-300"></span>
                    <span>Collections</span>
                    <svg class="w-3 h-3 transition-transform duration-500"
                        :class="mobOpen ? 'rotate-180 text-rose-600' : 'group-hover:translate-y-1'" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="mobOpen" x-collapse
                    class="bg-gray-50/50 dark:bg-white/1 divide-y divide-gray-100 dark:divide-white/5 border-t border-gray-100 dark:border-white/5">
                    @foreach ($categories as $category)
                        @php $isCatActive = request()->route('slug') === $category->slug; @endphp
                        <a href="{{ route('member.collection', $category->slug) }}"
                            class="group flex justify-between items-center px-12 py-5 text-2xs font-black uppercase tracking-widest transition-all duration-300
                            {{ $isCatActive ? 'text-rose-600 bg-white dark:bg-gray-900' : 'text-gray-500 hover:text-rose-600 hover:pl-14 hover:bg-white dark:hover:bg-gray-900' }}">
                            <div class="flex items-center gap-3">
                                <span class="w-0 h-px bg-rose-600 group-hover:w-4 transition-all duration-300"></span>
                                <span>{{ $category->category_name }}</span>
                            </div>
                            <span
                                class="opacity-30 italic group-hover:opacity-100 group-hover:text-rose-600 transition-all">//
                                {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Archive Link --}}
            <a href="{{ route('member.archive.addresses') }}"
                class="group relative px-8 py-6 text-[11px] font-black uppercase tracking-[0.4em] transition-all duration-300
                {{ request()->routeIs('member.archive.*') ? 'text-rose-600 bg-gray-50/50 dark:bg-white/2' : 'text-gray-400 hover:text-rose-600 hover:pl-10 hover:bg-gray-50/30 dark:hover:bg-white/1' }}">
                <span
                    class="absolute left-0 top-0 w-1 h-full bg-rose-600 scale-y-0 group-hover:scale-y-100 transition-transform duration-300 origin-center"></span>
                {{ __('Archive') }}
            </a>

            {{-- User Section --}}
            <div class="p-8 bg-gray-50/80 dark:bg-white/3">
                <div class="flex items-center gap-4 mb-8 group/user cursor-pointer">
                    <div class="relative overflow-hidden">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=111827&color=fff"
                            class="w-14 h-14 grayscale group-hover/user:grayscale-0 transition-all duration-500 border border-gray-900 dark:border-white"
                            alt="Avatar">
                        <div
                            class="absolute inset-0 bg-rose-600/20 translate-y-full group-hover/user:translate-y-0 transition-transform duration-300">
                        </div>
                    </div>
                    <div>
                        <p
                            class="text-xs font-black text-gray-900 dark:text-white uppercase tracking-tighter group-hover/user:text-rose-600 transition-colors">
                            {{ Auth::user()->name }}</p>
                        <p class="text-[9px] text-rose-600 font-bold uppercase tracking-[0.2em]">
                            {{ Auth::user()->role }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ route('profile.edit') }}"
                        class="relative flex items-center justify-center py-4 bg-gray-950 dark:bg-white text-white dark:text-gray-950 text-[9px] font-black uppercase tracking-widest overflow-hidden group/btn transition-all active:scale-95">
                        <span
                            class="absolute inset-0 bg-rose-600 -translate-x-full group-hover/btn:translate-x-0 transition-transform duration-300"></span>
                        <span class="relative z-10 group-hover/btn:text-white transition-colors">Profile</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit"
                            class="cursor-pointer confirm-delete-btn w-full py-4 border-2 border-rose-600 text-rose-600 text-[9px] font-black uppercase tracking-widest transition-all hover:bg-rose-600 hover:text-white active:scale-95"
                            data-confirm-title="Ready to Sign Out?"
                            data-confirm-text="You will need to login again to manage your luxury collection."
                            data-confirm-button="SIGN OUT" onclick="event.preventDefault();">
                            {{ __('Sign Out') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
