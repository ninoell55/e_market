<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-8 text-center">
        <h2 class="text-2xl font-black tracking-tighter text-gray-900 dark:text-white uppercase">
            Welcome <span class="text-rose-600 italic font-serif">Back</span>
        </h2>
        <p class="text-2xs font-bold tracking-[0.2em] text-gray-400 uppercase mt-1">Authorized Access Only</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div class="space-y-1 group">
            <label
                class="text-2xs font-black uppercase tracking-widest text-gray-500 dark:text-gray-400 ml-1 group-focus-within:text-rose-600 transition-colors">Email
                Address</label>
            <input type="email" name="email" :value="old('email')" required autofocus
                class="block w-full px-5 py-4 bg-white/50 dark:bg-gray-800/50 border-gray-100 dark:border-gray-700 focus:border-rose-600 dark:focus:border-rose-600 focus:ring-4 focus:ring-rose-600/5 rounded-2xl transition-all duration-300 placeholder:text-gray-300 dark:placeholder:text-gray-600"
                placeholder="name@example.com">
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <div class="space-y-1 group">
            <div class="flex justify-between px-1">
                <label
                    class="text-2xs font-black uppercase tracking-widest text-gray-500 dark:text-gray-400 group-focus-within:text-rose-600 transition-colors">Password</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                        class="text-[9px] font-bold text-gray-400 hover:text-rose-600 uppercase tracking-tighter">Forgot?</a>
                @endif
            </div>
            <input type="password" name="password" required
                class="block w-full px-5 py-4 bg-white/50 dark:bg-gray-800/50 border-gray-100 dark:border-gray-700 focus:border-rose-600 dark:focus:border-rose-600 focus:ring-4 focus:ring-rose-600/5 rounded-2xl transition-all duration-300 placeholder:text-gray-300 dark:placeholder:text-gray-600"
                placeholder="••••••••">
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <div class="flex items-center px-1">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox"
                    class="w-4 h-4 rounded-md border-gray-300 text-rose-600 focus:ring-rose-600 transition-all cursor-pointer"
                    name="remember">
                <span
                    class="ms-2 text-2xs font-bold uppercase tracking-widest text-gray-400 group-hover:text-gray-600 transition-colors">{{ __('Stay Signed In') }}</span>
            </label>
        </div>

        <div class="pt-4">
            <button type="submit"
                class="group relative w-full flex items-center justify-center px-8 py-4 bg-gray-900 dark:bg-rose-600 text-white text-xs font-black uppercase tracking-[0.2em] rounded-2xl overflow-hidden transition-all duration-300 hover:shadow-[0_15px_30px_rgba(225,29,72,0.3)] active:scale-[0.98]">
                <span class="relative z-10">{{ __('Sign In') }}</span>
                <div
                    class="absolute inset-0 bg-rose-600 dark:bg-rose-700 translate-x-full group-hover:translate-x-0 transition-transform duration-500">
                </div>
            </button>
        </div>

        <p class="text-center text-2xs font-bold text-gray-400 uppercase tracking-widest pt-4">
            Don't have an account?
            <a href="{{ route('register') }}"
                class="text-rose-600 hover:text-rose-700 transition-colors border-b-2 border-rose-600/20 hover:border-rose-600 pb-0.5">Create
                One</a>
        </p>
    </form>
</x-guest-layout>
