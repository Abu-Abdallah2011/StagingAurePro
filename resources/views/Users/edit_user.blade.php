<x-guest-layout>
    <form method="POST" action="/users_database/{{$user->id}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- User Id -->
        <div>
            <x-input-label for="id" :value="__('User Id')" />
            <x-text-input id="id" class="block mt-1 w-full" type="text" name="id" value="{{ $user->id }}" required autofocus autocomplete="id" />
            <x-input-error :messages="$errors->get('id')" class="mt-2" />
        </div>

        <!-- Username -->
        <div class="mt-4">
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" value="{{ $user->username }}" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Role -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Role')" />
            <x-select-input id="role" class="block mt-1 w-full" type="text" name="role" value="{{ $user->role }}" required autofocus autocomplete="role" />
           <option>{{ $user->role }}</option>
           {{-- Roles for Super Admin --}}
           @can('isSuper')
           <option value="super_admin" {{ old('role') == 'super_admin' ? 'selected' : '' }}>SUPER_ADMIN</option>
       @endcan

       {{-- Roles for Admin --}}
       @can('isAdmin')
           <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>ADMIN</option>
           {{-- <option value="masjid" {{ old('role') == 'masjid' ? 'selected' : '' }}>MASJID</option> --}}
           {{-- <option value="clinic" {{ old('role') == 'clinic' ? 'selected' : '' }}>CLINIC</option> --}}
       @endcan

       {{-- Common roles --}}
       {{-- <option value="husband" {{ old('role') == 'husband' ? 'selected' : '' }}>HUSBAND</option> --}}
       <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>USER</option>
        </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ $user->email }}" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <br/>
            <x-primary-button class="ml-4">
                {{ __('Update') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
