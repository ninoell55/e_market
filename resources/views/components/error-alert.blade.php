@if ($errors->any() || session('error'))
    <div
        class="mx-6 mt-20 px-6 py-4 bg-red-50 border border-red-200 rounded-lg shadow-sm flex items-center gap-4 animate-fade-in">
        <div class="shrink-0">
            <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                    clip-rule="evenodd" />
            </svg>
        </div>
        <div class="flex-1">
            <p class="text-sm font-medium text-red-800 mb-2">Something wrong:</p>
            @if ($errors->any())
                <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @else
                <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                    <li>{{ session('error') }}</li>
                </ul>
            @endif
        </div>
        <button onclick="this.parentElement.style.display='none'" class="text-red-600 hover:text-red-800 shrink-0">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    clip-rule="evenodd" />
            </svg>
        </button>
    </div>
@endif
