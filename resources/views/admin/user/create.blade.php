<x-admin-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="p-4 lg:p-8 mx-auto sm:px-6 lg:px-8 space-y-8">
        {{-- Header --}}
        <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <h3 class="text-3xl font-black text-gray-900 dark:text-white tracking-tighter flex items-center">
                    <span class="w-2 h-8 bg-rose-600 mr-4 rounded-full"></span>
                    Add New User
                </h3>
                <p class="text-2xs font-bold text-gray-400 uppercase tracking-[0.2em] mt-2 ml-6">
                    Assign a new profile to the luxury management system.
                </p>
            </div>
            <a href="{{ route('admin.user.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2 text-xs font-bold text-gray-500 hover:text-rose-600 transition-all uppercase tracking-widest ml-6 md:ml-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                </svg>
                Back to collection
            </a>
        </div>

        <form action="{{ route('admin.user.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- Kolom Kiri: Form Utama --}}
                <div class="lg:col-span-2 space-y-6">
                    <div
                        class="bg-white dark:bg-gray-900 rounded-[2.5rem] p-8 sm:p-10 shadow-sm border border-gray-100 dark:border-gray-800">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">

                            {{-- Full Name --}}
                            <div class="group md:col-span-2">
                                <label
                                    class="block text-xs font-bold text-gray-500 dark:text-gray-400 mb-2 ml-1 group-focus-within:text-rose-600 transition-colors">
                                    Full name
                                </label>
                                <input type="text" name="name" value="{{ old('name') }}" required
                                    placeholder="Enter full name"
                                    class="w-full px-6 py-4 bg-gray-50 dark:bg-gray-950 border-none rounded-2xl focus:ring-2 focus:ring-rose-600/20 dark:text-white outline-none transition-all font-semibold placeholder:text-gray-400/50">
                                <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs" />
                            </div>

                            {{-- Email Address --}}
                            <div class="group md:col-span-2">
                                <label
                                    class="block text-xs font-bold text-gray-500 dark:text-gray-400 mb-2 ml-1 group-focus-within:text-rose-600 transition-colors">
                                    Email address
                                </label>
                                <input type="email" name="email" value="{{ old('email') }}" required
                                    placeholder="example@luxury.com"
                                    class="w-full px-6 py-4 bg-gray-50 dark:bg-gray-950 border-none rounded-2xl focus:ring-2 focus:ring-rose-600/20 dark:text-white outline-none transition-all font-semibold placeholder:text-gray-400/50">
                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs" />
                            </div>

                            {{-- Privilege Level --}}
                            <div class="group md:col-span-2">
                                <label
                                    class="block text-xs font-bold text-gray-500 dark:text-gray-400 mb-2 ml-1 group-focus-within:text-rose-600 transition-colors">
                                    Privilege level
                                </label>
                                <div class="relative">
                                    {{-- appearance-none ditambahkan untuk menghilangkan panah default browser --}}
                                    <select name="role" required
                                        class="w-full px-6 py-4 bg-gray-50 dark:bg-gray-950 border-none rounded-2xl focus:ring-2 focus:ring-rose-600/20 dark:text-white outline-none transition-all font-semibold appearance-none cursor-pointer">
                                        <option value="superadmin">Super Admin</option>
                                        <option value="admin">Admin</option>
                                        <option value="member">Member</option>
                                    </select>
                                </div>
                                <x-input-error :messages="$errors->get('role')" class="mt-2 text-xs" />
                            </div>

                            {{-- Password --}}
                            <div class="group">
                                <label
                                    class="block text-xs font-bold text-gray-500 dark:text-gray-400 mb-2 ml-1 group-focus-within:text-rose-600 transition-colors">
                                    Temporary password
                                </label>
                                <input type="password" name="password" required placeholder="••••••••"
                                    class="w-full px-6 py-4 bg-gray-50 dark:bg-gray-950 border-none rounded-2xl focus:ring-2 focus:ring-rose-600/20 dark:text-white outline-none transition-all font-semibold">
                                <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs" />
                            </div>

                            {{-- Confirm Password --}}
                            <div class="group">
                                <label
                                    class="block text-xs font-bold text-gray-500 dark:text-gray-400 mb-2 ml-1 group-focus-within:text-rose-600 transition-colors">
                                    Confirm password
                                </label>
                                <input type="password" name="password_confirmation" required placeholder="••••••••"
                                    class="w-full px-6 py-4 bg-gray-50 dark:bg-gray-950 border-none rounded-2xl focus:ring-2 focus:ring-rose-600/20 dark:text-white outline-none transition-all font-semibold">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Kolom Kanan: Actions & Status --}}
                <div class="space-y-6">
                    {{-- Info Card --}}
                    <div
                        class="bg-white dark:bg-gray-900 rounded-[2.5rem] p-8 shadow-sm border border-gray-100 dark:border-gray-800">
                        <h4
                            class="text-xs font-black text-gray-900 dark:text-white uppercase tracking-widest mb-4 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-rose-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            Security notice
                        </h4>
                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400 leading-relaxed">
                            Ensure the email address is correct. System credentials and login instructions will be
                            sent automatically to the registered member.
                        </p>
                    </div>

                    {{-- Action Buttons --}}
                    <div
                        class="bg-gray-900 dark:bg-white rounded-[2.5rem] p-8 shadow-2xl shadow-gray-200 dark:shadow-none space-y-4">
                        <button type="submit"
                            class="w-full py-5 bg-rose-600 text-white text-xs font-black uppercase tracking-[0.2em] rounded-2xl hover:bg-rose-500 transition-all duration-300 active:scale-[0.97] shadow-lg shadow-rose-600/20">
                            Register User
                        </button>
                        <a href="{{ route('admin.user.index') }}"
                            class="block w-full py-2 text-2xs font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest text-center hover:text-rose-600 transition-colors">
                            Cancel
                        </a>
                    </div>
                </div>

            </div>
        </form>
    </div>
</x-admin-layout>
