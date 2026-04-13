<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-10">
        <h2 class="text-4xl font-black tracking-tighter text-gray-900 dark:text-white uppercase leading-[0.9]">
            Welcome <br>
            <span class="text-rose-600 italic font-serif lowercase tracking-normal">Back</span>
        </h2>
        <p class="text-2xs font-black tracking-[0.3em] text-gray-400 uppercase mt-3 flex items-center gap-2">
            <span class="w-8 h-px bg-gray-200"></span>
            Authorized Access
        </p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div class="group">
            <label
                class="block text-2xs font-black uppercase tracking-widest text-gray-500 mb-1 ml-1 group-focus-within:text-rose-600 transition-colors">
                Email Identity
            </label>
            <input type="email" name="email" :value="old('email')" required autofocus
                class="block w-full px-5 py-4 bg-white dark:bg-gray-800 border-2 border-gray-100 dark:border-gray-800 focus:border-gray-900 dark:focus:border-rose-600 focus:ring-0 rounded-none transition-all duration-300 placeholder:text-gray-300 font-bold"
                placeholder="nino@aura.com">
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <div class="group">
            <div class="flex justify-between items-end mb-1 px-1">
                <label
                    class="text-2xs font-black uppercase tracking-widest text-gray-500 group-focus-within:text-rose-600 transition-colors">
                    Password
                </label>
            </div>
            <input type="password" name="password" required
                class="block w-full px-5 py-4 bg-white dark:bg-gray-800 border-2 border-gray-100 dark:border-gray-800 focus:border-gray-900 dark:focus:border-rose-600 focus:ring-0 rounded-none transition-all duration-300 placeholder:text-gray-300 font-bold"
                placeholder="••••••••">
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <div class="flex items-center px-1">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox"
                    class="w-4 h-4 border-2 border-gray-300 dark:border-gray-700 text-rose-600 focus:ring-0 transition-all cursor-pointer rounded-none"
                    name="remember">
                <span
                    class="ms-2 text-2xs font-black uppercase tracking-[0.2em] text-gray-400 group-hover:text-gray-600 transition-colors">
                    Stay Signed In
                </span>
            </label>
        </div>

        <div class="pt-2">
            <button type="submit"
                class="group relative w-full flex items-center justify-center px-8 py-5 bg-gray-900 dark:bg-rose-600 text-white text-[11px] font-black uppercase tracking-[0.4em] rounded-none overflow-hidden transition-all duration-300 active:scale-[0.98]">
                <span class="relative z-10">{{ __('Sign In') }}</span>
                <div
                    class="absolute inset-0 bg-rose-600 dark:bg-rose-700 translate-y-full group-hover:translate-y-0 transition-transform duration-500">
                </div>
            </button>
        </div>

        <div class="text-center pt-4">
            <p class="text-2xs font-bold text-gray-400 uppercase tracking-widest">
                New to Fashion Aura?
                <a href="{{ route('register') }}"
                    class="text-gray-900 dark:text-white border-b-2 border-rose-600 pb-0.5 ml-1 transition-colors hover:text-rose-600">
                    Sign Up
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
