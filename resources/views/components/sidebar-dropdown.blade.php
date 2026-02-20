@props(['active' => false, 'label'])

@php
    $classes = $active
        ? 'bg-gray-900 text-white dark:bg-rose-600 shadow-lg shadow-gray-200 dark:shadow-rose-900/20 hover:bg-rose-600 dark:hover:bg-gray-900'
        : 'text-gray-500 hover:bg-gray-50 dark:hover:bg-gray-900';
@endphp

{{-- 
  1. Kita kontrol 'open' menggunakan Alpine, bukan bawaan browser murni.
  2. x-effect: Jika isMinimized (dari parent) berubah jadi true, paksa open jadi false. 
--}}
<details x-data="{ open: {{ $active ? 'true' : 'false' }} }" x-effect="if (isMinimized) open = false" :open="open"
    class="group transition-none" {{ $active ? 'open' : '' }}>

    <summary {{-- Click override: Mencegah default toggle browser agar tidak tabrakan dengan logic kita --}}
        @click.prevent="if(isMinimized) { isMinimized = false; open = true; } else { open = !open }"
        class="list-none w-full flex items-center h-11 rounded-xl cursor-pointer transition-colors {{ $classes }} overflow-hidden select-none">

        <div class="w-12 shrink-0 flex items-center justify-center {{ $active ? '' : 'group-hover:text-rose-600' }}">
            {{ $icon }}
        </div>

        {{-- Teks disembunyikan pakai x-show agar tidak merusak lebar sidebar saat mini --}}
        <span x-show="!isMinimized"
            class="text-sm font-bold flex-1 text-left uppercase tracking-widest leading-none whitespace-nowrap duration-0">
            {{ $label }}
        </span>

        <div x-show="!isMinimized" class="flex items-center justify-center mr-4 transition-transform duration-300"
            :class="open ? 'rotate-180' : ''">
            <svg class="w-3 h-3 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </div>
    </summary>

    {{-- Submenu hanya dirender/tampil jika sidebar lebar --}}
    <div x-show="!isMinimized && open" x-cloak
        class="ml-12 mt-1 space-y-1 border-l border-gray-100 dark:border-gray-800 overflow-hidden">
        {{ $slot }}
    </div>
</details>
