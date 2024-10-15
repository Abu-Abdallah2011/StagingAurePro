<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile Registration Form') }}
        </h2>
    </x-slot>

    <div class="py-12">


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                
                    <section>

                        <form method="POST" action="{{ url('profiles_reg_form') }}" enctype="multipart/form-data">
                            @csrf
                    
                            <!-- User Id -->
                            @if (Gate::allows('isAdmin'))
                            <div>
                                <x-input-label for="user_id" :value="__('User Id')" />
                                <x-text-input id="user_id" class="block mt-1 w-full" type="text" name="user_id" value="{{ $userId }}" required autofocus autocomplete="user_id" />
                                <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                            </div>
                            @else
                            <div>
                                <x-text-input id="user_id" class="block mt-1 w-full hidden" type="text" name="user_id" value="{{ $userId }}" required inactive autofocus autocomplete="user_id" />
                                <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                            </div>
                            @endif

                            <!-- First Name -->
                            <div>
                                <x-input-label for="first_name" :value="__('First Name')" />
                                <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="first_name" />
                                <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                            </div>

                            <!-- Surname -->
                            <div>
                                <x-input-label for="surname" :value="__('Surname')" />
                                <x-text-input id="surname" class="block mt-1 w-full" type="text" name="surname" :value="old('surname')" required autofocus autocomplete="surname" />
                                <x-input-error :messages="$errors->get('surname')" class="mt-2" />
                            </div>

                            <!-- Gender -->
                            <div>
                                <x-input-label for="gender" :value="__('Gender')" />
                                <select id="gender" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full" type="text" name="gender" :value="old('gender')" required autofocus autocomplete="gender">
                                    <option>MALE</option>
                                    <option>FEMALE</option>
                                </select>
                                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                            </div>

                            <!-- NIN -->
                            <div>
                                <x-input-label for="nin" :value="__('National Identity Number(NIN)')" />
                                <x-text-input id="nin" class="block mt-1 w-full" type="text" name="nin" :value="old('nin')" required autofocus autocomplete="nin" />
                                <x-input-error :messages="$errors->get('nin')" class="mt-2" />
                            </div>

                        <!-- Address -->
                        <div>
                            <x-input-label for="address" :value="__('Address')" />
                            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autofocus autocomplete="address" />
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>

                        <!-- Phone Number -->
                        <div>
                            <x-input-label for="phone" :value="__('Phone Number')" />
                            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required autofocus autocomplete="phone" />
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>
                    
                           <!-- Email -->
                           <div>
                            <x-input-label for="email" :value="__('User Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="text" placeholder="Input User Email if Any" name="email" :value="old('email')" required autofocus autocomplete="email" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Photo Upload -->
                        <div>
                            <x-input-label for="photo" :value="__('Photo')" />
                            <x-text-input id="file" class="block mt-1 w-full" type="file" name="photo" :value="old('photo')" autofocus autocomplete="photo" />
                            <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                        </div>

                        <!-- NIN Slip Upload -->
                        <div>
                            <x-input-label for="nin_slip" :value="__('Upload NIN Slip')" />
                            <x-text-input id="file" class="block mt-1 w-full" type="file" name="nin_slip" :value="old('nin_slip')" autofocus autocomplete="nin_slip" />
                            <x-input-error :messages="$errors->get('nin_slip')" class="mt-2" />
                        </div>
                    
                            <br/>
                        <div>
                            <x-primary-button class="ml-3">
                                {{ __('Save') }}
                            </x-primary-button>
                        </div>
                        </form>
                    </section>
            </div>
        </div>
    </div>
</x-app-layout>
