<x-admin-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="py-12 bg-gray-50/50 dark:bg-gray-950 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div>
                    <h3 class="text-3xl font-black text-gray-900 dark:text-white tracking-tighter flex items-center">
                        <span class="w-2 h-8 bg-rose-600 mr-4 rounded-full"></span>
                        Update User
                    </h3>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mt-2 ml-6">
                        Modify profile details for <span class="text-rose-600 font-bold">{{ $user->email }}</span>
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

            <form action="{{ route('admin.user.update', $user) }}" method="POST">
                @csrf
                @method('PUT')

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
                                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
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
                                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                        required placeholder="example@luxury.com"
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
                                        <select name="role" required
                                            class="w-full px-6 py-4 bg-gray-50 dark:bg-gray-950 border-none rounded-2xl focus:ring-2 focus:ring-rose-600/20 dark:text-white outline-none transition-all font-semibold appearance-none cursor-pointer">
                                            <option value="superadmin"
                                                {{ old('role', $user->role) == 'superadmin' ? 'selected' : '' }}>Super
                                                Admin</option>
                                            <option value="admin"
                                                {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin
                                            </option>
                                            <option value="member"
                                                {{ old('role', $user->role) == 'member' ? 'selected' : '' }}>Member
                                            </option>
                                        </select>
                                    </div>
                                    <x-input-error :messages="$errors->get('role')" class="mt-2 text-xs" />
                                </div>

                                {{-- Password Section Note --}}
                                <div class="md:col-span-2 pt-4 border-t border-gray-50 dark:border-gray-800">
                                    <p class="text-2xs font-black uppercase tracking-widest text-gray-400">Security
                                        Update (Optional)</p>
                                </div>

                                {{-- New Password --}}
                                <div class="group">
                                    <label
                                        class="block text-xs font-bold text-gray-500 dark:text-gray-400 mb-2 ml-1 group-focus-within:text-rose-600 transition-colors">
                                        New password
                                    </label>
                                    <input type="password" name="password" placeholder="Leave blank to keep current"
                                        class="w-full px-6 py-4 bg-gray-50 dark:bg-gray-950 border-none rounded-2xl focus:ring-2 focus:ring-rose-600/20 dark:text-white outline-none transition-all font-semibold placeholder:text-gray-400/50">
                                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs" />
                                </div>

                                {{-- Confirm New Password --}}
                                <div class="group">
                                    <label
                                        class="block text-xs font-bold text-gray-500 dark:text-gray-400 mb-2 ml-1 group-focus-within:text-rose-600 transition-colors">
                                        Confirm new password
                                    </label>
                                    <input type="password" name="password_confirmation"
                                        placeholder="Repeat new password"
                                        class="w-full px-6 py-4 bg-gray-50 dark:bg-gray-950 border-none rounded-2xl focus:ring-2 focus:ring-rose-600/20 dark:text-white outline-none transition-all font-semibold placeholder:text-gray-400/50">
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- Kolom Kanan: Actions --}}
                    <div class="space-y-6">
                        <div
                            class="bg-white dark:bg-gray-900 rounded-[2.5rem] p-8 shadow-sm border border-gray-100 dark:border-gray-800">
                            <h4
                                class="text-xs font-black text-gray-900 dark:text-white uppercase tracking-widest mb-4 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-rose-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Edit Information
                            </h4>
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 leading-relaxed">
                                Changing the email address will require the user to log in with their new credentials.
                                If password is left blank, the current password remains active.
                            </p>
                        </div>

                        <div
                            class="bg-gray-900 dark:bg-white rounded-[2.5rem] p-8 shadow-2xl shadow-gray-200 dark:shadow-none space-y-4">
                            <button type="submit"
                                class="w-full py-5 bg-rose-600 text-white text-xs font-black uppercase tracking-[0.2em] rounded-2xl hover:bg-rose-500 transition-all duration-300 active:scale-[0.97] shadow-lg shadow-rose-600/20">
                                Save Changes
                            </button>
                            <a href="{{ route('admin.user.index') }}"
                                class="block w-full py-2 text-2xs font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest text-center hover:text-rose-600 transition-colors">
                                Discard changes
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
