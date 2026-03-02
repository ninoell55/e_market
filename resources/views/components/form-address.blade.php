<div class="min-h-screen bg-white dark:bg-[#0a0a0a] text-black dark:text-white antialiased">

    {{-- Header Tengah (Sesuai gaya Index) --}}
    <header class="px-6 py-16 border-b border-gray-100 dark:border-white/5">
        <div class="flex flex-col items-center">
            <h1 class="text-4xl font-black uppercase tracking-tighter italic text-center">
                {{ isset($address) ? 'Edit_Record' : 'New_Registry' }}<span class="text-rose-600">.</span>
            </h1>
            <a href="{{ route('member.archive.index') }}"
                class="mt-4 text-[9px] font-black uppercase tracking-[0.3em] opacity-30 hover:opacity-100 transition-all">
                ← Back_to_Archive
            </a>
        </div>
    </header>

    <main class="max-w-3xl mx-auto px-6 py-20">
        <form
            action="{{ isset($address) ? route('member.archive.update_address', $address->label) : route('member.archive.store_address') }}"
            method="POST" class="space-y-12">
            @csrf
            @if (isset($address))
                @method('PUT')
            @endif

            {{-- Section 01: Identification --}}
            <div class="space-y-6">
                <p class="text-2xs font-black uppercase tracking-[0.5em] text-rose-600 italic">01. Identification
                </p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="text-[9px] font-black uppercase tracking-widest opacity-50">Entry_Label</label>
                        <input type="text" name="label" value="{{ old('label', $address->label ?? '') }}"
                            placeholder="e.g. Home, Office"
                            class="w-full bg-transparent border-b-2 border-gray-100 dark:border-white/10 focus:border-black dark:focus:border-white transition-colors py-3 px-0 text-sm font-bold uppercase tracking-tight outline-none">
                        @error('label')
                            <span class="text-[8px] font-black text-rose-600 uppercase">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="text-[9px] font-black uppercase tracking-widest opacity-50">Recipient_Name</label>
                        <input type="text" name="recipient_name"
                            value="{{ old('recipient_name', $address->recipient_name ?? '') }}"
                            class="w-full bg-transparent border-b-2 border-gray-100 dark:border-white/10 focus:border-black dark:focus:border-white transition-colors py-3 px-0 text-sm font-bold uppercase tracking-tight outline-none">
                    </div>
                </div>
            </div>

            {{-- Section 02: Logistics --}}
            <div class="space-y-6">
                <p class="text-2xs font-black uppercase tracking-[0.5em] text-rose-600 italic">02. Logistics</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="text-[9px] font-black uppercase tracking-widest opacity-50">Phone_Number</label>
                        <input type="text" name="recipient_phone"
                            value="{{ old('recipient_phone', $address->recipient_phone ?? '') }}"
                            class="w-full bg-transparent border-b-2 border-gray-100 dark:border-white/10 focus:border-black dark:focus:border-white transition-colors py-3 px-0 text-sm font-mono font-bold outline-none">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-[9px] font-black uppercase tracking-widest opacity-50">Province</label>
                            <input type="text" name="province"
                                value="{{ old('province', $address->province ?? '') }}"
                                class="w-full bg-transparent border-b-2 border-gray-100 dark:border-white/10 focus:border-black dark:focus:border-white transition-colors py-3 px-0 text-sm font-bold uppercase outline-none">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[9px] font-black uppercase tracking-widest opacity-50">City</label>
                            <input type="text" name="city" value="{{ old('city', $address->city ?? '') }}"
                                class="w-full bg-transparent border-b-2 border-gray-100 dark:border-white/10 focus:border-black dark:focus:border-white transition-colors py-3 px-0 text-sm font-bold uppercase outline-none">
                        </div>
                    </div>
                </div>
                <div class="space-y-2">
                    <label
                        class="text-[9px] font-black uppercase tracking-widest opacity-50">Full_Address_Details</label>
                    <textarea name="address" rows="3"
                        class="w-full bg-transparent border-b-2 border-gray-100 dark:border-white/10 focus:border-black dark:focus:border-white transition-colors py-3 px-0 text-sm font-medium leading-relaxed outline-none resize-none">{{ old('address', $address->address ?? '') }}</textarea>
                </div>
            </div>

            {{-- Action Button --}}
            <div class="pt-10">
                <button type="submit"
                    class="w-full bg-black dark:bg-white text-white dark:text-black py-6 text-xs font-black uppercase tracking-[0.5em] hover:bg-rose-600 dark:hover:bg-rose-600 dark:hover:text-white transition-all">
                    {{ isset($address) ? 'Update_Record' : 'Authorize_&_Save' }}
                </button>
            </div>
        </form>
    </main>
</div>
