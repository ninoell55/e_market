@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'inline-flex items-center px-8 text-[11px] font-black uppercase tracking-[0.4em] border-r border-gray-100 dark:border-white/5 text-rose-600 bg-gray-50/50 dark:bg-white/2 transition-all duration-300 ease-in-out shadow-[inset_0_-2px_0_0_#e11d48]'
            : 'inline-flex items-center px-8 text-[11px] font-black uppercase tracking-[0.4em] border-r border-gray-100 dark:border-white/5 text-gray-400 hover:text-gray-950 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-white/5 transition-all duration-300 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
