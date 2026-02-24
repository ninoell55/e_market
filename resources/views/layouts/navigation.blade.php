<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route(Auth::user()->getDashboardRouteName()) }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route(Auth::user()->getDashboardRouteName())" :active="request()->routeIs(Auth::user()->getDashboardRouteName())">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
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
                            <p class="text-[11px] font-black text-gray-900 dark:text-white truncate lowercase">
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
                                    class="confirm-delete-btn rounded-lg text-2xs font-bold uppercase tracking-widest text-rose-600 transition-all cursor-pointer"
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

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route(Auth::user()->getDashboardRouteName())" :active="request()->routeIs(Auth::user()->getDashboardRouteName())">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
