<x-admin-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="max-w-7xl mx-auto space-y-10 py-6">
        <div class="relative overflow-hidden bg-gray-900 dark:bg-rose-950/20 rounded-[2.5rem] p-10 sm:p-14 shadow-2xl">
            <div class="relative z-10">
                <p class="text-rose-500 text-2xs font-black uppercase tracking-[0.4em] mb-4">Welcome Back</p>
                <h1 class="text-4xl sm:text-5xl font-black text-white mb-4 tracking-tighter">
                    Hello, {{ explode(' ', Auth::user()->name)[0] }}! <span class="text-rose-500">.</span>
                </h1>
                <p class="text-gray-400 text-sm max-w-md leading-relaxed tracking-wide">
                    The system is ready to be monitored. All store performance data has been updated in real time for
                    the current day.
                </p>
            </div>

            <div class="absolute right-0 top-0 w-1/3 h-full bg-linear-to-l from-rose-600/10 to-transparent"></div>
            <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-rose-600/10 rounded-full blur-[100px]"></div>
        </div>
    </div>
</x-admin-layout>
