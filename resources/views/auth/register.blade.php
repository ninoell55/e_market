<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-2xl font-black tracking-tighter text-gray-900 dark:text-white uppercase">
            Join the <span class="text-rose-600 italic font-serif">Aura</span>
        </h2>
        <p class="text-2xs font-bold tracking-[0.2em] text-gray-400 uppercase mt-1">Create your boutique account</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div class="space-y-1 group">
            <label
                class="text-2xs font-black uppercase tracking-widest text-gray-500 dark:text-gray-400 ml-1 group-focus-within:text-rose-600 transition-colors">Full
                Name</label>
            <input id="name" type="text" name="name" :value="old('name')" required autofocus
                autocomplete="name"
                class="block w-full px-5 py-3.5 bg-white/50 dark:bg-gray-800/50 border-gray-100 dark:border-gray-700 focus:border-rose-600 dark:focus:border-rose-600 focus:ring-4 focus:ring-rose-600/5 rounded-2xl transition-all duration-300 placeholder:text-gray-300"
                placeholder="Eleanor Aura">
            <x-input-error :messages="$errors->get('name')" class="mt-1 text-2xs" />
        </div>

        <div class="space-y-1 group">
            <label
                class="text-2xs font-black uppercase tracking-widest text-gray-500 dark:text-gray-400 ml-1 group-focus-within:text-rose-600 transition-colors">Email
                Address</label>
            <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username"
                class="block w-full px-5 py-3.5 bg-white/50 dark:bg-gray-800/50 border-gray-100 dark:border-gray-700 focus:border-rose-600 dark:focus:border-rose-600 focus:ring-4 focus:ring-rose-600/5 rounded-2xl transition-all duration-300 placeholder:text-gray-300"
                placeholder="aura@example.com">
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-2xs" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="space-y-1 group">
                <label
                    class="text-2xs font-black uppercase tracking-widest text-gray-500 dark:text-gray-400 ml-1 group-focus-within:text-rose-600 transition-colors">Password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                    class="block w-full px-5 py-3.5 bg-white/50 dark:bg-gray-800/50 border-gray-100 dark:border-gray-700 focus:border-rose-600 dark:focus:border-rose-600 focus:ring-4 focus:ring-rose-600/5 rounded-2xl transition-all duration-300 placeholder:text-gray-300"
                    placeholder="••••••••">
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-2xs" />
            </div>

            <div class="space-y-1 group">
                <label
                    class="text-2xs font-black uppercase tracking-widest text-gray-500 dark:text-gray-400 ml-1 group-focus-within:text-rose-600 transition-colors">Confirm</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    autocomplete="new-password"
                    class="block w-full px-5 py-3.5 bg-white/50 dark:bg-gray-800/50 border-gray-100 dark:border-gray-700 focus:border-rose-600 dark:focus:border-rose-600 focus:ring-4 focus:ring-rose-600/5 rounded-2xl transition-all duration-300 placeholder:text-gray-300"
                    placeholder="••••••••">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-2xs" />
            </div>
        </div>

        <div class="flex items-start px-1 pt-2">
            <p class="text-[9px] text-gray-400 leading-relaxed uppercase tracking-wider font-medium">
                By registering, you agree to our <a href="#" class="text-rose-600 hover:underline">Terms of
                    Service</a> and <a href="#" class="text-rose-600 hover:underline">Privacy Policy</a>.
            </p>
        </div>

        <div class="pt-4">
            <button type="submit"
                class="group relative w-full flex items-center justify-center px-8 py-4 bg-gray-900 dark:bg-rose-600 text-white text-xs font-black uppercase tracking-[0.2em] rounded-2xl overflow-hidden transition-all duration-300 hover:shadow-[0_15px_30px_rgba(225,29,72,0.3)] active:scale-[0.98]">
                <span class="relative z-10">{{ __('Create Account') }}</span>
                <div
                    class="absolute inset-0 bg-rose-600 dark:bg-rose-700 translate-x-full group-hover:translate-x-0 transition-transform duration-500">
                </div>
            </button>
        </div>

        <div class="text-center pt-4">
            <a class="text-2xs font-black uppercase tracking-widest text-gray-400 hover:text-rose-600 transition-colors border-b-2 border-transparent hover:border-rose-600 pb-1"
                href="{{ route('login') }}">
                {{ __('Already a member? Sign In') }}
            </a>
        </div>
    </form>
</x-guest-layout>
