@props(['align' => 'right', 'width' => '64', 'contentClasses' => 'bg-white dark:bg-gray-950'])

@php
$alignmentClasses = match ($align) {
    'left' => 'start-0',
    'top' => 'bottom-full mb-2',
    default => 'end-0',
};

// Pastikan width menggunakan class Tailwind atau value custom
$widthClass = match ($width) {
    '48' => 'w-48',
    '56' => 'w-56',
    '64' => 'w-64',
    default => $width,
};
@endphp

<div class="relative h-full flex items-center" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
    <div @click="open = ! open" class="h-full">
        {{ $trigger }}
    </div>

    <div x-show="open"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="absolute z-100 top-full {{ $widthClass }} {{ $alignmentClasses }} shadow-[20px_20px_60px_rgba(0,0,0,0.1)] dark:shadow-[0_20px_50px_rgba(0,0,0,0.5)]"
            style="display: none;"
            @click="open = false">
        
        <div class="border border-gray-100 dark:border-white/10 overflow-hidden {{ $contentClasses }}">
            {{ $content }}
        </div>

        <div class="h-1 w-full bg-rose-600"></div>
    </div>
</div>