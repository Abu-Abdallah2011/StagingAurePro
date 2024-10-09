<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Wife Edit Form') }}
        </h2>
    </x-slot>

    <div class="py-12">


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                
                    <section>

                        <form method="POST" action="/wives_database/{{$wife->id}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                    
                            <!-- User Id -->
                            <div>
                                <x-input-label for="user_id" :value="__('Wife User Id')" />
                                <x-text-input id="user_id" class="block mt-1 w-full" type="text" name="user_id" value="{{ $wife->user_id }}" required autofocus autocomplete="user_id" />
                                <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                            </div>

                            <!-- Id -->
                            <div>
                                <x-input-label for="id" :value="__('Wife Id')" />
                                <x-text-input id="id" class="block mt-1 w-full" type="text" name="id" value="{{ $wife->id }}" required autofocus autocomplete="id" />
                                <x-input-error :messages="$errors->get('id')" class="mt-2" />
                            </div>

                            <!-- First Name -->
                            <div>
                                <x-input-label for="first_name" :value="__('First Name')" />
                                <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" value="{{ $wife->first_name }}" required autofocus autocomplete="first_name" />
                                <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                            </div>

                            <!-- Surname -->
                            <div>
                                <x-input-label for="surname" :value="__('Surame')" />
                                <x-text-input id="surname" class="block mt-1 w-full" type="text" name="surname" value="{{ $wife->surname }}" required autofocus autocomplete="surname" />
                                <x-input-error :messages="$errors->get('surname')" class="mt-2" />
                            </div>

                            <!-- NIN -->
                            <div>
                                <x-input-label for="nin" :value="__('National Identity Number(NIN)')" />
                                <x-text-input id="nin" class="block mt-1 w-full" type="text" name="nin" value="{{ $wife->nin }}" required autofocus autocomplete="nin" />
                                <x-input-error :messages="$errors->get('nin')" class="mt-2" />
                            </div>

                        <!-- Address -->
                        <div>
                            <x-input-label for="address" :value="__('Address')" />
                            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" value="{{ $wife->address }}" required autofocus autocomplete="address" />
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>

                        <!-- wife Phone Number -->
                        <div>
                            <x-input-label for="phone" :value="__('Phone Number')" />
                            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" value="{{ $wife->phone }}" required autofocus autocomplete="phone" />
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>
                    
                           <!-- Email -->
                           <div>
                            <x-input-label for="email" :value="__('Wife Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="text" name="email" value="{{ $wife->email }}" required autofocus autocomplete="email" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Photo Upload -->
                        <div>
                            <x-input-label for="photo" :value="__('Photo')" />
                            <x-text-input id="file" class="block mt-1 w-full" type="file" name="photo" :value="old('photo')" autofocus autocomplete="photo" />
                            <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                                @if ($wife->photo)
                                <img class="hidden w-48 mr-6 md:block" src="{{ Storage::disk('s3')->url($wife->photo) }}" alt="" />
                                @endif
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
