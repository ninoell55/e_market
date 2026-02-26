<x-member-layout>
    <div
        class="min-h-screen bg-white dark:bg-gray-950 text-gray-950 dark:text-white font-sans overflow-hidden flex flex-col">

        <div class="max-w-400 mx-auto px-6 lg:px-12 py-10 border-b border-gray-100 dark:border-white/5">
            <div class="flex items-center gap-3 mb-2">
                <span class="w-1 h-1 bg-rose-600"></span>
                <p class="text-[9px] font-black uppercase tracking-[0.5em] text-rose-600 italic">User_Archive</p>
            </div>
            <h1 class="text-7xl lg:text-8xl font-black uppercase italic tracking-tighter">
                Log<span class="text-rose-600">.</span>Manifest
            </h1>
        </div>

        <div
            class="max-w-400 w-full mx-auto flex flex-col lg:flex-row flex-1 overflow-hidden divide-x-0 lg:divide-x divide-gray-100 dark:divide-white/5">

            <div class="w-full lg:w-2/3 flex flex-col h-full bg-white dark:bg-gray-950">
                <div
                    class="px-6 lg:px-12 py-6 border-b border-gray-100 dark:border-white/5 flex justify-between items-center bg-gray-50/50 dark:bg-white/2">
                    <div class="flex items-center gap-4">
                        <span class="text-2xs font-black uppercase tracking-[0.3em]">01 // Order_History</span>
                        <div class="h-3 w-px bg-gray-300 dark:bg-white/20"></div>
                        <span class="text-2xs font-bold text-gray-400 uppercase tracking-widest tabular-nums">Rows:
                            42</span>
                    </div>
                </div>

                <div class="overflow-y-auto flex-1 no-scrollbar px-6 lg:px-12">
                    <div class="divide-y divide-gray-100 dark:divide-white/5">
                        <div
                            class="grid grid-cols-12 gap-4 py-4 text-[8px] font-black uppercase tracking-[0.3em] text-gray-400 sticky top-0 bg-white dark:bg-gray-950 z-10">
                            <div class="col-span-2">Timestamp</div>
                            <div class="col-span-3">Order_ID</div>
                            <div class="col-span-4">Manifest_Description</div>
                            <div class="col-span-1 text-center">Status</div>
                            <div class="col-span-2 text-right">Valuation</div>
                        </div>

                        @for ($i = 0; $i < 20; $i++)
                            <div
                                class="grid grid-cols-12 gap-4 py-6 group hover:bg-gray-50 dark:hover:bg-white/2 transition-colors items-center cursor-pointer">
                                <div class="col-span-2 text-2xs font-bold tabular-nums text-gray-400">
                                    2026.02.{{ 28 - $i }}</div>
                                <div
                                    class="col-span-3 text-xs font-black uppercase italic tracking-tight group-hover:text-rose-600 transition-colors">
                                    #ARC-99{{ $i }}55</div>
                                <div class="col-span-4 flex flex-col">
                                    <span
                                        class="text-2xs font-black uppercase tracking-widest truncate">Vanguard_Oversize_Tee_Black</span>
                                    <span class="text-[8px] text-gray-400 font-medium uppercase italic">+ 02
                                        MANIFEST_UNITS</span>
                                </div>
                                <div class="col-span-1 flex justify-center">
                                    <span
                                        class="w-1.5 h-1.5 rounded-full {{ $i == 0 ? 'bg-rose-600' : 'bg-gray-200 dark:bg-white/10' }}"></span>
                                </div>
                                <div
                                    class="col-span-2 text-right text-sm font-black italic tracking-tighter tabular-nums">
                                    $145.00</div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/3 flex flex-col bg-gray-50/50 dark:bg-white/1 h-full">
                <div class="px-8 py-6 border-b border-gray-100 dark:border-white/5 flex justify-between items-center">
                    <span class="text-2xs font-black uppercase tracking-[0.3em]">02 // Shipping_Addres</span>
                    <button class="text-[18px] font-light hover:text-rose-600 transition-colors">+</button>
                </div>

                <div class="p-8 space-y-4 overflow-y-auto no-scrollbar">
                    <div class="bg-white dark:bg-gray-900 border border-gray-950 dark:border-white p-5 group relative">
                        <p class="text-[7px] font-black text-rose-600 uppercase tracking-widest mb-3 italic">[
                            ACTIVE_NODE ]</p>
                        <h4 class="text-sm font-black uppercase italic tracking-wider mb-2">Home_Base_01</h4>
                        <p class="text-[9px] font-medium text-gray-400 uppercase leading-relaxed line-clamp-2 mb-4">
                            Jl. Sudirman No. 55, South Jakarta, DKI Jakarta, 12190. ID
                        </p>
                        <div class="flex gap-4 border-t border-gray-100 dark:border-white/5 pt-3">
                            <button
                                class="text-[8px] font-black uppercase tracking-widest hover:text-rose-600 transition-colors">Edit</button>
                        </div>
                    </div>

                    @for ($j = 0; $j < 3; $j++)
                        <div
                            class="border border-gray-100 dark:border-white/5 p-5 hover:border-gray-400 transition-all bg-white/50 dark:bg-transparent">
                            <h4 class="text-sm font-black uppercase italic tracking-wider mb-1">
                                Office_Node_{{ $j + 2 }}</h4>
                            <p class="text-[9px] text-gray-400 uppercase truncate mb-3">SCBD Tower Level 14, Unit B,
                                Jakarta...</p>
                            <div class="flex gap-3">
                                <button
                                    class="text-[7px] font-black uppercase tracking-widest text-gray-400 hover:text-gray-950 dark:hover:text-white">Default</button>
                                <span class="text-gray-200">/</span>
                                <button
                                    class="text-[7px] font-black uppercase tracking-widest text-gray-400 hover:text-rose-600">Delete</button>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</x-member-layout>
