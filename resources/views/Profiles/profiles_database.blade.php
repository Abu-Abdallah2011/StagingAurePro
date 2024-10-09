<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profiles Database') }}
            @can('isAdmin')
            <a href="profiles_reg_form">
                <x-primary-button class="absolute top-15 right-9 bg-green-500">
                    <i class="fa-solid fa-user-plus"></i>
                </x-primary-button> 
                </a>
                @endcan
        </h2>
    </x-slot>
            <!-- Session Status -->
        <x-success-status class="mb-4" :status="session('message')" />
        <x-search-profiles />
        
        <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
                
            @foreach ($profiles as $profile)

            <div class="bg-green-300 border border-gray-200 rounded p-6">
                
                <div class="flex">
                    {{-- @if ($profile->photo)
                    <img class="hidden w-48 mr-6 md:block" src="{{ Storage::disk('s3')->url($profile->photo) }}" alt="" />
                    @endif --}}

                    <div class="font-bold">
                        <h3 class="text-2xl">
                            {{$profile->id}}
                        </h3>
                    
                    <div class="font-bold">
                        <h3 class="text-2xl">
                            <a href="{{ url('/profiles_database/' . $profile->id) }}">{{$profile->first_name}} {{$profile->surname}}</a>
                        </h3>
                        <div class="text-xl mb-4">
                            Gender: {{$profile->gender}}
                        <div class="text-xl mb-4">
                            NIN Number: {{$profile->nin}}
                            <div class="text-xl mb-4">
                            Phone Number: {{$profile->phone}}
                                    <div class="text-xl mb-4">
                                    Email: {{$profile->email}}
                            <div class="text-lg mt-4">
                                <i class="fa-solid fa-location-dot"></i>
                                {{$profile->address}}
                                {{-- <div class="text-sm mt-4">
                                    Added by: {{ $masjid->created_by }} at: {{ $masjid->created_at }}
                                     <br/>
                                    Edited by: {{ $masjid->edited_by }} at: {{ $masjid->updated_at }}
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>

                    </div>
                </div>
            </div>
            </div>
            </div>

            @endforeach
                </div>
                

                <div class="mt-6 p-4">
                    {{$profiles->Links()}}
                </div>

</x-app-layout>
