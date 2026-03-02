@props([
    'title' => '404',
    'message' => 'Not Found.',
    'buttonText' => 'Refresh',
    'buttonLink' => url()->current(),
])

<div
    class="col-span-full relative group flex flex-col items-center justify-center py-28 px-6 border border-gray-100 dark:border-white/5 bg-gray-50/30 dark:bg-white/1 overflow-hidden">

    {{-- Aksen Pojok --}}
    <div class="absolute top-0 left-0 p-8 opacity-20 group-hover:opacity-40 transition-opacity duration-700">
        <div class="flex flex-col gap-1">
            <div class="w-10 h-px bg-gray-400"></div>
            <div class="w-px h-10 bg-gray-400"></div>
        </div>
        <span class="text-[7px] font-mono text-gray-400 uppercase tracking-[0.5em] mt-2 block italic">System_Idle</span>
    </div>

    {{-- Icon dengan Ambient Pulse --}}
    <div class="relative mb-10">
        {{-- Ring Luar yang Berdenyut --}}
        <div class="absolute inset-0 rounded-full border border-rose-600/20 scale-150 animate-ping opacity-20"></div>
        <div
            class="absolute inset-0 rounded-full border border-rose-600/10 scale-[2] animate-[ping_3s_linear_infinite] opacity-10">
        </div>

        {{-- Glow Core --}}
        <div class="absolute inset-0 bg-rose-600/10 blur-3xl rounded-full scale-150 animate-pulse"></div>

        <svg class="relative w-20 h-20 text-gray-300 dark:text-gray-700 group-hover:text-rose-600/40 transition-colors duration-700"
            fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="0.5"
                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
        </svg>
    </div>

    {{-- Content --}}
    <div class="text-center relative z-10 max-w-sm">
        <h3 class="text-3xl font-black uppercase -tracking-wider text-gray-950 dark:text-white mb-4">
            {{ $title }}
        </h3>

        {{-- Loading Indicator Dots --}}
        <div class="flex items-center justify-center gap-1.5 mb-6">
            <div class="w-1 h-1 bg-rose-600 animate-bounce [animation-delay:-0.3s]"></div>
            <div class="w-1 h-1 bg-rose-600 animate-bounce [animation-delay:-0.15s]"></div>
            <div class="w-1 h-1 bg-rose-600 animate-bounce"></div>
        </div>

        <p
            class="text-2xs font-medium text-gray-400 dark:text-gray-500 uppercase tracking-[0.3em] leading-relaxed italic opacity-80">
            {{ $message }}
        </p>
    </div>

    {{-- Action Button --}}
    <a href="{{ $buttonLink }}"
        class="group/btn mt-14 relative overflow-hidden px-12 py-4 bg-gray-950 dark:bg-white transition-all active:scale-95 shadow-2xl">
        {{-- Shine Effect on Hover --}}
        <div
            class="absolute inset-0 w-1/2 h-full bg-linear-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover/btn:animate-[shimmer_1.5s_infinite] pointer-events-none">
        </div>

        <span
            class="relative z-10 text-2xs font-black uppercase tracking-[0.4em] text-white dark:text-gray-950 group-hover/btn:text-rose-500 transition-colors">
            {{ $buttonText }}
        </span>
    </a>
</div>

{{-- Tambahkan custom CSS ini di file CSS kamu atau di dalam tag <style> --}}
<style>
    @keyframes shimmer {
        0% {
            transform: translateX(-100%);
        }

        100% {
            transform: translateX(200%);
        }
    }
</style>
