@props(['active' => false, 'href' => '#'])

<a href="{{ $href }}"
    {{ $attributes->merge([
        'class' =>
            'block py-2.5 px-4 text-xs font-bold uppercase tracking-widest transition-colors whitespace-nowrap overflow-hidden ' .
            ($active ? 'text-rose-600' : 'text-gray-400 hover:text-rose-600'),
    ]) }}>
    {{ $slot }}
</a>
