<x-app-layout>
    @if ($title ?? false)
        <x-slot:title>{{ $title }}</x-slot:title>
    @endif
    
    @section('main')
        <main class="p-4 lg:p-8">
            {{ $slot }}
        </main>
    @endsection

    @include('layouts.sidebar')
</x-app-layout>
