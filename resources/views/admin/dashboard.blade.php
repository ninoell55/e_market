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

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @php
                $stats = [
                    [
                        'label' => 'Total Sales',
                        'value' => 'Rp 12.4M',
                        'icon' =>
                            'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                    ],
                    ['label' => 'New Orders', 'value' => '142', 'icon' => 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z'],
                    [
                        'label' => 'Visitors',
                        'value' => '2.8k',
                        'icon' =>
                            'M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z',
                    ],
                ];
            @endphp

            @foreach ($stats as $stat)
                <div
                    class="group bg-white dark:bg-gray-950 rounded-4xl border border-gray-100 dark:border-gray-900 p-8 shadow-sm hover:shadow-xl hover:border-rose-100 dark:hover:border-rose-900/30 transition-all duration-500">
                    <div class="flex justify-between items-start mb-6">
                        <div
                            class="w-12 h-12 bg-gray-50 dark:bg-gray-900 rounded-2xl flex items-center justify-center text-gray-400 group-hover:text-rose-600 transition-colors duration-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="{{ $stat['icon'] }}" />
                            </svg>
                        </div>
                        <span
                            class="text-2xs font-black text-green-500 bg-green-50 dark:bg-green-500/10 px-3 py-1 rounded-full uppercase tracking-tighter">+12.5%</span>
                    </div>
                    <div>
                        <p class="text-2xs font-black text-gray-400 uppercase tracking-[0.2em] mb-1">
                            {{ $stat['label'] }}</p>
                        <h3 class="text-3xl font-black text-gray-900 dark:text-white tracking-tighter">
                            {{ $stat['value'] }}</h3>
                    </div>
                </div>
            @endforeach
        </div>

        <div
            class="h-96 bg-gray-50 dark:bg-gray-900/50 rounded-[3rem] border-2 border-dashed border-gray-100 dark:border-gray-800 flex items-center justify-center">
            <p class="text-2xs font-black text-gray-300 dark:text-gray-700 uppercase tracking-[0.5em]">Main Chart
                Area</p>
        </div>
    </div>
</x-admin-layout>
