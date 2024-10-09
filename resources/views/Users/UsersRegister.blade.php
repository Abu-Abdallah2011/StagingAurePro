<x-guest-layout>
    <form method="POST" action="{{ route('usersRegister.store') }}">
        @csrf

        <!-- Username -->
        <div>
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Role -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Role')" />
            <select id="role" 
        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full" 
        name="role" required autocomplete="role">
                <option value="" {{ old('role') == '' ? 'selected' : '' }}>Select Role</option>

                {{-- Roles for Super Admin --}}
                @can('isSuper')
                    <option value="super_admin" {{ old('role') == 'super_admin' ? 'selected' : '' }}>SUPER_ADMIN</option>
                @endcan

                {{-- Roles for Admin --}}
                @can('isAdmin')
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>ADMIN</option>
                    {{-- <option value="masjid" {{ old('role') == 'masjid' ? 'selected' : '' }}>MASJID</option>
                    <option value="clinic" {{ old('role') == 'clinic' ? 'selected' : '' }}>CLINIC</option> --}}
                @endcan

                {{-- Common roles --}}
                {{-- <option value="husband" {{ old('role') == 'husband' ? 'selected' : '' }}>HUSBAND</option> --}}
                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>USER</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
