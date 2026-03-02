@php
    $layout = Auth::user()->role === 'superadmin' || Auth::user()->role === 'admin' ? 'admin-layout' : 'member-layout';
@endphp

<x-dynamic-component :component="$layout">
    <div class="min-h-screen bg-white dark:bg-gray-950 text-gray-950 dark:text-white font-sans selection:bg-rose-600">
        <div class="max-w-400 mx-auto px-6 lg:px-12 py-10 border-b border-gray-100 dark:border-white/5">
            <div class="flex items-center gap-3 mb-2">
                <span class="w-1 h-1 bg-rose-600"></span>
                <p class="text-[9px] font-black uppercase tracking-[0.5em] text-rose-600 italic">Account_Settings</p>
            </div>
            <h1 class="text-5xl lg:text-8xl font-black uppercase italic tracking-tighter">
                Profile<span class="text-rose-600">.</span>Core
            </h1>
        </div>

        <div
            class="max-w-400 mx-auto grid grid-cols-1 lg:grid-cols-12 divide-y lg:divide-y-0 lg:divide-x divide-gray-100 dark:divide-white/5 border-b border-gray-100 dark:border-white/5">

            <div class="lg:col-span-4 p-8 lg:p-12 bg-gray-50/30 dark:bg-white/1">
                <div class="sticky top-12">
                    <h3 class="text-2xs font-black uppercase tracking-[0.4em] text-gray-400 mb-8 italic">//
                        01_Identity</h3>
                    <div
                        class="p-8 border border-gray-950 dark:border-white bg-white dark:bg-gray-900 shadow-[6px_6px_0px_0px_rgba(225,29,72,1)]">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4 p-8 lg:p-12">
                <h3 class="text-2xs font-black uppercase tracking-[0.4em] text-gray-400 mb-8 italic">//
                    02_Authentication</h3>
                <div class="p-0 lg:p-4">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="lg:col-span-4 p-8 lg:p-12 bg-rose-600/2">
                <h3 class="text-2xs font-black uppercase tracking-[0.4em] text-rose-600 mb-8 italic">//
                    03_Termination</h3>
                <div class="p-0 lg:p-4 border-l-2 border-rose-600/20 pl-6">
                    <p class="text-[9px] font-medium uppercase tracking-widest text-gray-400 mb-6 leading-relaxed">
                        Warning: Deleting the account will wipe all manifest data and node history permanently.
                    </p>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-dynamic-component>
