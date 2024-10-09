<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Imams Database') }}
            @can('isAdmin')
            <a href="imams_reg_form">
                <x-primary-button class="absolute top-15 right-9 bg-green-500">
                    <i class="fa-solid fa-user-plus"></i>
                </x-primary-button> 
                </a>
                @endcan
        </h2>
    </x-slot>
            <!-- Session Status -->
        <x-success-status class="mb-4" :status="session('message')" />
        <x-search-imams />
        
        <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
                
            @foreach ($imams as $imam)

            <div class="bg-green-300 border border-gray-200 rounded p-6">
                
                <div class="flex">
                    @if ($imam->photo)
                    <img class="hidden w-48 mr-6 md:block" src="{{ Storage::disk('s3')->url($imam->photo) }}" alt="" />
                    @endif

                    <div class="font-bold">
                        <h3 class="text-2xl">
                            {{$imam->id}}
                        </h3>
                    
                    <div class="font-bold">
                        <h3 class="text-2xl">
                            <a href="{{ url('/imams_database/' . $imam->id) }}">{{$imam->name}}</a>
                        </h3>
                            <div class="text-xl mb-4">
                            Phone Number: {{$imam->phone}}
                                    <div class="text-xl mb-4">
                                    Email: {{$imam->email}}
                            <div class="text-lg mt-4">
                                <i class="fa-solid fa-location-dot"></i>
                                {{$imam->address}}
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

            @endforeach
                </div>
                

                <div class="mt-6 p-4">
                    {{$imams->Links()}}
                </div>

</x-app-layout>
