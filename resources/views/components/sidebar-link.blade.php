@props(['active' => false, 'href' => '#'])

<a href="{{ $href }}"
    {{ $attributes->merge([
        'class' =>
            'flex items-center h-11 rounded-xl transition-all duration-200 group ' .
            ($active
                ? 'bg-gray-900 text-white dark:bg-rose-600 shadow-lg shadow-gray-200 dark:shadow-rose-900/20 hover:bg-rose-600 dark:hover:bg-gray-600' 
                : 'text-gray-500 hover:bg-gray-50 dark:hover:bg-gray-800'),
    ]) }}>

    {{-- Wadah Ikon --}}
    <div class="w-12 shrink-0 flex items-center justify-center {{ $active ? '' : 'group-hover:text-rose-600' }}">
        {{ $icon }}
    </div>

    {{-- Teks --}}
    <span
        class="text-sm font-bold uppercase tracking-widest flex-1 leading-none {{ $active ? '' : 'group-hover:text-gray-900 dark:group-hover:text-white' }}">
        {{ $slot }}
    </span>
</a>
