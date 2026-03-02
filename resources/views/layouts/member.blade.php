<x-app-layout>
    @if ($title ?? false)
        <x-slot:title>{{ $title }}</x-slot:title>
    @endif
    
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <main>
            {{ $slot }}
            <x-footer />
        </main>
    </div>
</x-app-layout>
