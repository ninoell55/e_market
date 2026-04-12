@props(['address' => null, 'title' => 'Registry_Entry'])

<form action="{{ $address ? route('member.archive.update_address', $address) : route('member.archive.store_address') }}"
    method="POST" class="space-y-16">
    @csrf
    @if ($address)
        @method('PUT')
    @endif

    {{-- Section 01: Identification --}}
    <div class="space-y-8">
        <div class="flex items-center gap-4">
            <span class="text-2xs font-black px-2 py-1 bg-rose-600 text-white italic">01</span>
            <p class="text-2xs font-black uppercase tracking-[0.5em] opacity-50 italic">Identification</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            {{-- Label --}}
            <div class="group space-y-2">
                <label
                    class="text-[9px] font-black uppercase tracking-widest opacity-40 group-focus-within:opacity-100 group-focus-within:text-rose-600 transition-all">Label</label>
                <input type="text" name="label" value="{{ old('label', $address->label ?? '') }}"
                    placeholder="Home, Office, Parents..."
                    class="w-full bg-transparent border-b-2 border-gray-100 dark:border-white/10 focus:border-black dark:focus:border-white transition-all py-3 px-3 text-sm font-black tracking-tight outline-none placeholder:opacity-20 {{ $errors->has('label') ? 'border-rose-600' : '' }}">
                @error('label')
                    <p class="text-[9px] font-black text-rose-600 uppercase tracking-tighter mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Recipient Name --}}
            <div class="group space-y-2">
                <label
                    class="text-[9px] font-black uppercase tracking-widest opacity-40 group-focus-within:opacity-100 group-focus-within:text-rose-600 transition-all">Recipient Name</label>
                <input type="text" name="recipient_name"
                    value="{{ old('recipient_name', $address->recipient_name ?? '') }}" placeholder="Full Name"
                    class="w-full bg-transparent border-b-2 border-gray-100 dark:border-white/10 focus:border-black dark:focus:border-white transition-all py-3 px-3 text-sm font-black tracking-tight outline-none {{ $errors->has('recipient_name') ? 'border-rose-600' : '' }}">
                @error('recipient_name')
                    <p class="text-[9px] font-black text-rose-600 uppercase tracking-tighter mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    {{-- Section 02: Logistics --}}
    <div class="space-y-8">
        <div class="flex items-center gap-4">
            <span class="text-2xs font-black px-2 py-1 bg-rose-600 text-white italic">02</span>
            <p class="text-2xs font-black tracking-[0.5em] opacity-50 italic">Full Address</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            {{-- Phone - Menggunakan type="tel" agar muncul numpad di mobile --}}
            <div class="group space-y-2">
                <label
                    class="text-[9px] font-black uppercase tracking-widest opacity-40 group-focus-within:opacity-100 group-focus-within:text-rose-600 transition-all">Phone_Link</label>
                <input type="tel" name="recipient_phone"
                    value="{{ old('recipient_phone', $address->recipient_phone ?? '') }}" placeholder="62812..."
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                    class="w-full bg-transparent border-b-2 border-gray-100 dark:border-white/10 focus:border-black dark:focus:border-white transition-all py-3 px-3 text-sm font-mono font-bold outline-none {{ $errors->has('recipient_phone') ? 'border-rose-600' : '' }}">
                @error('recipient_phone')
                    <p class="text-[9px] font-black text-rose-600 uppercase tracking-tighter mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Province & City --}}
            <div class="grid grid-cols-2 gap-4">
                <div class="group space-y-2">
                    <label
                        class="text-[9px] font-black uppercase tracking-widest opacity-40 group-focus-within:opacity-100 group-focus-within:text-rose-600 transition-all">Province</label>
                    <input type="text" name="province" value="{{ old('province', $address->province ?? '') }}"
                        class="w-full bg-transparent border-b-2 border-gray-100 dark:border-white/10 focus:border-black dark:focus:border-white transition-all py-3 px-3 text-sm font-black outline-none">
                </div>
                <div class="group space-y-2">
                    <label
                        class="text-[9px] font-black uppercase tracking-widest opacity-40 group-focus-within:opacity-100 group-focus-within:text-rose-600 transition-all">City</label>
                    <input type="text" name="city" value="{{ old('city', $address->city ?? '') }}"
                        class="w-full bg-transparent border-b-2 border-gray-100 dark:border-white/10 focus:border-black dark:focus:border-white transition-all py-3 px-3 text-sm font-black outline-none">
                </div>
            </div>
        </div>

        {{-- Full Address --}}
        <div class="group space-y-2">
            <label
                class="text-[9px] font-black uppercase tracking-widest opacity-40 group-focus-within:opacity-100 group-focus-within:text-rose-600 transition-all">Full_Address_Details</label>
            <textarea name="address" rows="3"
                class="w-full bg-transparent border-b-2 border-gray-100 dark:border-white/10 focus:border-black dark:focus:border-white transition-all py-3 px-3 text-sm font-medium leading-relaxed outline-none resize-none placeholder:opacity-20"
                placeholder="STREET NAME, BUILDING, SUITE...">{{ old('address', $address->address ?? '') }}</textarea>
            @error('address')
                <p class="text-[9px] font-black text-rose-600 uppercase tracking-tighter mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- Action Button --}}
    <div class="pt-10">
        <button type="submit"
            class="w-full bg-black dark:bg-white text-white dark:text-black py-8 text-[11px] font-black uppercase tracking-[0.6em] hover:bg-rose-600 dark:hover:bg-rose-600 dark:hover:text-white transition-all duration-500 italic">
            {{ $address ? 'Update Address' : 'Add Address' }}
        </button>
    </div>
</form>
