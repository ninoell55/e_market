<x-guest-layout>
    <div class="mb-10">
        <h2 class="text-4xl font-black tracking-tighter text-gray-900 dark:text-white uppercase leading-[0.9]">
            Create <br>
            <span class="text-rose-600 italic font-serif lowercase tracking-normal">Account</span>
        </h2>
        <p class="text-2xs font-black tracking-[0.3em] text-gray-400 uppercase mt-3 flex items-center gap-2">
            <span class="w-8 h-px bg-gray-200"></span>
            Exclusive Access
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div class="group">
            <label
                class="block text-2xs font-black uppercase tracking-widest text-gray-500 mb-1 ml-1 group-focus-within:text-rose-600 transition-colors">Full
                Name</label>
            <input id="name" type="text" name="name" :value="old('name')" required autofocus
                class="block w-full px-5 py-4 bg-white dark:bg-gray-800 border-2 border-gray-100 dark:border-gray-800 focus:border-gray-900 dark:focus:border-rose-600 focus:ring-0 rounded-none transition-all duration-300 placeholder:text-gray-300 font-bold"
                placeholder="Nino Adityo">
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        <div class="group">
            <label
                class="block text-2xs font-black uppercase tracking-widest text-gray-500 mb-1 ml-1 group-focus-within:text-rose-600 transition-colors">Email
                Address</label>
            <input id="email" type="email" name="email" :value="old('email')" required
                class="block w-full px-5 py-4 bg-white dark:bg-gray-800 border-2 border-gray-100 dark:border-gray-800 focus:border-gray-900 dark:focus:border-rose-600 focus:ring-0 rounded-none transition-all duration-300 placeholder:text-gray-300 font-bold"
                placeholder="nino@aura.com">
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="group">
                <label
                    class="block text-2xs font-black uppercase tracking-widest text-gray-500 mb-1 ml-1 group-focus-within:text-rose-600 transition-colors">Password</label>
                <input id="password" type="password" name="password" required
                    class="block w-full px-5 py-4 bg-white dark:bg-gray-800 border-2 border-gray-100 dark:border-gray-800 focus:border-gray-900 dark:focus:border-rose-600 focus:ring-0 rounded-none transition-all duration-300 placeholder:text-gray-300 font-bold"
                    placeholder="••••••••">
            </div>
            <div class="group">
                <label
                    class="block text-2xs font-black uppercase tracking-widest text-gray-500 mb-1 ml-1 group-focus-within:text-rose-600 transition-colors">Confirm
                    Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    class="block w-full px-5 py-4 bg-white dark:bg-gray-800 border-2 border-gray-100 dark:border-gray-800 focus:border-gray-900 dark:focus:border-rose-600 focus:ring-0 rounded-none transition-all duration-300 placeholder:text-gray-300 font-bold"
                    placeholder="••••••••">
            </div>
        </div>
        <x-input-error :messages="$errors->get('password')" class="mt-1" />

        <div class="pt-4">
            <button type="submit"
                class="group relative w-full flex items-center justify-center px-8 py-5 bg-gray-900 dark:bg-rose-600 text-white text-[11px] font-black uppercase tracking-[0.4em] rounded-none overflow-hidden transition-all duration-300 active:scale-[0.98]">
                <span class="relative z-10">{{ __('Sign Up') }}</span>
                <div
                    class="absolute inset-0 bg-rose-600 dark:bg-rose-700 translate-y-full group-hover:translate-y-0 transition-transform duration-500">
                </div>
            </button>
        </div>

        <div class="text-center pt-2">
            <p class="text-2xs font-bold text-gray-400 uppercase tracking-widest">
                Already a Member?
                <a href="{{ route('login') }}"
                    class="text-gray-900 dark:text-white border-b-2 border-rose-600 pb-0.5 ml-1">Sign In</a>
            </p>
        </div>
    </form>
</x-guest-layout>
