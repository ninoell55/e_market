<x-member-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="min-h-screen bg-white dark:bg-[#050505] text-black dark:text-white antialiased">

        {{-- Section 01: Clean Header --}}
        <header
            class="relative px-6 lg:px-12 pt-20 pb-5 border-b border-black/5 dark:border-white/5 bg-white dark:bg-[#0a0a0a]">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-8">
                <div class="relative">
                    <h1 class="text-6xl md:text-8xl font-black uppercase tracking-tighter leading-none italic">
                        Add <span class="text-gray-300 text-2xl md:text-4xl">New Address</span>
                    </h1>
                </div>

                {{-- Back Button --}}
                <a href="{{ route('member.archive.addresses') }}"
                    class="group flex items-center justify-center gap-3 px-8 py-4 border-2 border-black dark:border-white text-2xs font-black uppercase tracking-widest hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to Archive
                </a>
            </div>
        </header>

        {{-- Section 02: Main Content Area --}}
        <main class="border-b border-black/5 dark:border-white/5">
            <div class="grid grid-cols-1 lg:grid-cols-12">

                {{-- Left Side: Context --}}
                <div
                    class="lg:col-span-4 p-8 lg:p-16 border-b lg:border-b-0 lg:border-r border-black/5 dark:border-white/5 bg-gray-50/50 dark:bg-white/1">
                    <div class="sticky top-30 space-y-8">
                        <div>
                            <h2 class="text-2xl font-black uppercase italic tracking-tighter">Location<br>Details</h2>
                            <div class="w-12 h-1 bg-rose-600 mt-4"></div>
                        </div>
                        <p class="text-xs font-bold opacity-40 leading-relaxed uppercase tracking-widest">
                            Please provide precise shipping coordinates. Accuracy in this registry ensures seamless
                            delivery of your orders.
                        </p>

                        {{-- Quick Info List --}}
                        <ul class="space-y-4 pt-8">
                            <li class="flex items-center gap-3 text-[9px] font-black uppercase opacity-30">
                                <span class="w-1 h-1 bg-current"></span> Supports Multiple Addresses
                            </li>
                            <li class="flex items-center gap-3 text-[9px] font-black uppercase opacity-30">
                                <span class="w-1 h-1 bg-current"></span> Ensure Address Accuracy for Timely Deliveries
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Right Side: Form (No side padding on mobile) --}}
                <div class="lg:col-span-8 bg-white dark:bg-[#0a0a0a]">
                    <div class="p-6 lg:p-20">
                        <x-form-address />
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-member-layout>
