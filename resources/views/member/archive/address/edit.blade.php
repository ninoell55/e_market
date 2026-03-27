<x-member-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="min-h-screen bg-white dark:bg-[#0a0a0a] text-black dark:text-white">
        <header class="px-6 py-20 border-b border-gray-100 dark:border-white/5 flex flex-col items-center text-center">
            <h1 class="text-5xl font-black uppercase tracking-tighter italic">Edit_Record<span
                    class="text-rose-600">.</span></h1>
            <a href="{{ route('member.archive.addresses') }}"
                class="mt-6 text-2xs font-black uppercase tracking-[0.4em] opacity-30 hover:opacity-100 transition-all">←
                Back_to_Archive</a>
        </header>
        <main class="max-w-3xl mx-auto px-6 py-20">
            <x-form-address :address="$address" />
        </main>
    </div>
</x-member-layout>
