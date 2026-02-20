@unless ($breadcrumbs->isEmpty())
    @foreach ($breadcrumbs as $breadcrumb)
        @if ($breadcrumb->url && !$loop->last)
            <a href="{{ $breadcrumb->url }}"
                class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:underline">
                {{ $breadcrumb->title }}
            </a>
            <span class="mx-1">/</span>
        @else
            <span class="text-black text-lg italic font-extrabold dark:text-white">{{ $breadcrumb->title }}</span>
        @endif
    @endforeach
@endunless
