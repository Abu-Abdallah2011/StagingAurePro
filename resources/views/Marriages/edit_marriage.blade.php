<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Marriage Edit Form') }}
        </h2>
    </x-slot>

    <div class="py-12">


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                
                    <section>

                        <form method="POST" action="/marriages_database/{{$marriage->id}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            @if($marriage->status !== 'approved' || Gate::allows('isAdmin'))
                            <!-- Marriage Id -->
                            <div>
                                <x-input-label for="id" :value="__('Marriage Id')" />
                                <x-text-input id="id" class="block mt-1 w-full" type="text" name="id" value="{{ $marriage->id }}" required autofocus autocomplete="id" />
                                <x-input-error :messages="$errors->get('id')" class="mt-2" />
                            </div>

                            <!-- Husband Id -->
                            <div>
                                <x-input-label for="husband_id" :value="__('Husband Id')" />
                                <x-text-input id="husband_id" class="block mt-1 w-full" type="text" name="husband_id" value="{{ $marriage->husband_id }}" autofocus autocomplete="husband_id" />
                                <x-input-error :messages="$errors->get('husband_id')" class="mt-2" />
                            </div>

                            <!-- Wife Id -->
                            <div>
                                <x-input-label for="wife_id" :value="__('Wife Id')" />
                                <x-text-input id="wife_id" class="block mt-1 w-full" type="text" name="wife_id" value="{{ $marriage->wife_id }}" autofocus autocomplete="wife_id" />
                                <x-input-error :messages="$errors->get('wife_id')" class="mt-2" />
                            </div>
                            @endif

                            <!-- Waliyy Id -->
                            <div>
                                <x-input-label for="waliyy_id" :value="__('Waliyy Id')" />
                                <x-text-input id="waliyy_id" class="block mt-1 w-full" type="text" name="waliyy_id" value="{{ $marriage->waliyy_id }}" required autofocus autocomplete="waliyy_id" />
                                <x-input-error :messages="$errors->get('waliyy_id')" class="mt-2" />
                            </div>

                            <!-- Wakil Id -->
                            <div>
                                <x-input-label for="wakil_id" :value="__('Wakil Id')" />
                                <x-text-input id="wakil_id" class="block mt-1 w-full" type="text" name="wakil_id" value="{{ $marriage->wakil_id }}" required autofocus autocomplete="wakil_id" />
                                <x-input-error :messages="$errors->get('wakil_id')" class="mt-2" />
                            </div>
                    
                            <!-- Date -->
                            <div>
                                <x-input-label for="date" :value="__('Date')" />
                                <x-date-picker id="date" class="block mt-1 w-full" type="text" name="date" value="{{ $marriage->date }}" required autofocus autocomplete="date" />
                                <x-input-error :messages="$errors->get('date')" class="mt-2" />
                            </div>

                        <!-- Time -->
                        <div>
                            <x-input-label for="time" :value="__('Time')" />
                            <x-time-picker id="time" class="block mt-1 w-full" type="text" name="time" value="{{ $marriage->time }}" required autofocus autocomplete="time" />
                            <x-input-error :messages="$errors->get('time')" class="mt-2" />
                        </div>

                        <!-- Venue Id -->
                        @if($marriage->masjid)
                        <div>
                            <x-input-label for="venue_id" :value="__('Venue')" />
                            <select id="venue_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" type="text" name="venue_id" value="{{ $marriage->venue_id }}" required autofocus autocomplete="venue_id">
                                <option value="{{ $marriage->masjid->id }}">{{ $marriage->masjid->name }}</option>
                                @foreach ($masajid as $masjid)
                                    <option value="{{ $masjid->id }}">
                                        {{ $masjid->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('venue_id')" class="mt-2" />
                        </div>
                        @endif
                    
                           <!-- Venue -->
                           <div>
                            <x-input-label for="venue" :value="__('Marriage Venue')" />
                            <x-text-input id="venue" class="block mt-1 w-full" type="text" name="venue" value="{{ $marriage->venue }}" required autofocus autocomplete="venue" />
                            <x-input-error :messages="$errors->get('venue')" class="mt-2" />
                        </div>
                    
                           <!-- Dowry -->
                           <div>
                            <x-input-label for="dowry" :value="__('Dowry')" />
                            <x-text-input id="dowry" class="block mt-1 w-full" type="text" name="dowry" value="{{ $marriage->dowry }}" required autofocus autocomplete="dowry" />
                            <x-input-error :messages="$errors->get('dowry')" class="mt-2" />
                        </div>

                        <!-- Dowry Status -->
                        <div>
                            <x-input-label for="dowry_status" :value="__('Dowry Status')" />
                            <select id="dowry_status" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" type="text" name="dowry_status" value="{{ $marriage->dowry_status }}" required autofocus autocomplete="dowry_status">
                                <OPtion>{{ $marriage->dowry_status }}</OPtion>
                                <OPtion value="paid">PAID</OPtion>
                                <OPtion value="unpaid">UNPAID</OPtion>
                            </select>
                            <x-input-error :messages="$errors->get('dowry_status')" class="mt-2" />
                        </div>

                        @if($marriage->status !== 'approved' || Gate::allows('isAdmin'))
                        <!-- Husband Test -->
                        <div>
                            <x-input-label for="husband_test" :value="__('Husband Test')" />
                            <x-text-input id="husband_test" class="block mt-1 w-full" type="file" name="husband_test" value="{{ $marriage->husband_test }}" autofocus autocomplete="husband_test" />
                            <x-input-error :messages="$errors->get('husband_test')" class="mt-2" />
                        </div>

                        <!-- Wife Test -->
                        <div>
                            <x-input-label for="wife_test" :value="__('Wife Test')" />
                            <x-text-input id="wife_test" class="block mt-1 w-full" type="file" name="wife_test" value="{{ $marriage->wife_test }}" autofocus autocomplete="wife_test" />
                            <x-input-error :messages="$errors->get('wife_test')" class="mt-2" />
                        </div>
                        @endif
                    
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
