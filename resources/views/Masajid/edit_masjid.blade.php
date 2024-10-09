<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Masjid Edit Form') }}
        </h2>
    </x-slot>

    <div class="py-12">


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                
                    <section>

        <form method="POST" action="/masajid_database/{{$masjid->id}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
    
            <!-- Masjid Id -->
            <div>
                <x-input-label for="id" :value="__('Masjid Id')" />
                <x-text-input id="id" class="block mt-1 w-full" type="text" name="id" value="{{ $masjid->id }}"  autofocus autocomplete="id" />
                <x-input-error :messages="$errors->get('id')" class="mt-2" />
            </div>

            <!-- User Id -->
            {{-- <div>
                <x-input-label for="user_id" :value="__('User Id')" />
                <x-text-input id="user_id" class="block mt-1 w-full" type="text" name="user_id" value="{{ $masjid->user_id }}"  autofocus autocomplete="user_id" />
                <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
            </div> --}}
    
            <!-- Fullname -->
            <div>
                <x-input-label for="name" :value="__('Fullname')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $masjid->name }}" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
        
            <!-- Masjid C.A.C REgistration Number -->
            <div>
            <x-input-label for="cac_reg" :value="__('C.A.C Registration Number')" />
            <x-text-input id="cac_reg" class="block mt-1 w-full" type="text" name="cac_reg" value="{{ $masjid->cac_reg }}" required autofocus autocomplete="cac_reg" />
            <x-input-error :messages="$errors->get('cac_reg')" class="mt-2" />
        </div>
    
            <!-- Email -->
            <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="text" name="email" value="{{ $masjid->email }}" required autofocus autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
    
        <!-- Address -->
        <div>
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" value="{{ $masjid->address }}" required autofocus autocomplete="address" />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

            <!-- Masjid Account Number -->
            <div>
                <x-input-label for="acct_no" :value="__('Masjid Account Number')" />
                <x-text-input id="acct_no" class="block mt-1 w-full" type="text" name="acct_no" value="{{ $masjid->acct_no }}" autofocus autocomplete="acct_no" />
                <x-input-error :messages="$errors->get('acct_no')" class="mt-2" />
            </div>
    
            <!-- Masjid Account Name -->
            <div>
            <x-input-label for="acct_name" :value="__('Masjid Account Name')" />
            <x-text-input id="acct_name" class="block mt-1 w-full" type="text" name="acct_name" value="{{ $masjid->acct_name }}" required autofocus autocomplete="acct_name" />
            <x-input-error :messages="$errors->get('acct_name')" class="mt-2" />
        </div>
    
            <!-- Bank Branch -->
            <div>
                <x-input-label for="bank" :value="__('Bank Branch')" />
                <x-text-input id="bank" class="block mt-1 w-full" type="text" name="bank" value="{{ $masjid->bank }}" autofocus autocomplete="bank" />
                <x-input-error :messages="$errors->get('bank')" class="mt-2" />
            </div>

            <!-- Imam Id -->
            <div>
                <x-input-label for="imam_id" :value="__('Imam Id')" />
                <x-text-input id="imam_id" class="block mt-1 w-full" type="text" name="imam_id" value="{{ $imam->id ?? 0 }}" required autofocus autocomplete="imam_id" />
                <x-input-error :messages="$errors->get('imam_id')" class="mt-2" />
            </div>

            <!-- Muazzin -->
            <div>
                <x-input-label for="muazzin_id" :value="__('Muazzin Id')" />
                <x-text-input id="muazzin_id" class="block mt-1 w-full" type="text" name="muazzin_id" value="{{ $muazzin->id ?? 0 }}" required autofocus autocomplete="muazzin_id" />
                <x-input-error :messages="$errors->get('muazzin_id')" class="mt-2" />
            </div>

            <!-- Masjid Bank Branch -->
            <div>
                <x-input-label for="chairman_id" :value="__('Chairman Id')" />
                <x-text-input id="chairman_id" class="block mt-1 w-full" type="text" name="chairman_id" value="{{ $chairman->id ?? 0 }}" required autofocus autocomplete="chairman_id" />
                <x-input-error :messages="$errors->get('chairman_id')" class="mt-2" />
            </div>
            
                            <br/>
                        <div>
                            <x-primary-button class="ml-3">
                                {{ __('Update') }}
                            </x-primary-button>
                        </div>
                        </form>
                    </section>
            </div>
        </div>
    </div>
</x-app-layout>
