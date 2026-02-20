<x-app-layout>
    @if ($title ?? false)
        <x-slot:title>{{ $title }}</x-slot:title>
    @endif
    
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <x-success-alert />
        <x-error-alert />

        <main>
            {{ $slot }}
        </main>
    </div>
</x-app-layout>
