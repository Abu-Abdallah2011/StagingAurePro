<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                  
            
            <div class="bg-gray-50 border border-gray-200 rounded p-6">
                <div class="flex">
                    <div class="">

                            <div>
                                <h5 class="text-base">
                                   ID: {{$masjid->id}}
                                </h5>

                                {{-- @if($teacher->user)
                                @can('isAdmin') MASJID USER ID:<a href="/users_database/{{$teacher->user->id}}/edit_user"> {{$teacher->user->id}}</a>@endcan
                                @endif --}}
                       
                        <div>
                        <h5 class="text-base">
                           MASJID NAME: {{$masjid->name}}
                        </h5>

                        @if($imam)
                        <div>
                            <h5 class="text-base">
                               IMAM NAME: <a href="{{ url('/profiles_database/' . $imam->id) }}">{{$imam->first_name}} {{$imam->surname}}</a>
                            </h5>
                            @endif

                            @if($muazzin)
                            <div>
                                <h5 class="text-base">
                                   MU'AZZIN NAME: <a href="{{ url('/profiles_database/' . $muazzin->id) }}">{{$muazzin->first_name}} {{$muazzin->surname}}</a>
                                </h5>
                                @endif

                                @if($chairman)
                                <div>
                                    <h5 class="text-base">
                                       CHAIRMAN NAME: <a href="{{ url('/profiles_database/' . $chairman->id) }}">{{$chairman->first_name}} {{$chairman->surname}}</a>
                                    </h5>
                                    @endif
                    
                        <div class="text-xl mb-4">
                            <h5 class="text-base">
                           MASJID C.A.C REGISTRATION NUMBER: {{$masjid->cac_reg}}
                            </h5>
                            
                        <div class="text-xl mb-4">
                            <h5 class="text-base">
                           MASJID EMAIL: {{$masjid->email}}
                            </h5>
                            <div class="text-xl mb-4">
                                <h5 class="text-base">
                               ACCOUNT NUMBER: {{$masjid->acct_no}}
                                </h5>
                            <div class="text-xl mb-4">
                                <h5 class="text-base">
                            ACCOUNT NAME: {{$masjid->acct_name}}
                                </h5>
                                <div class="text-xl mb-4">
                                    <h5 class="text-base">
                                BANK BRANCH: {{$masjid->bank}}
                                    </h5>
                                    <div class="text-lg mt-4">
                                        <i class="fa-solid fa-location-dot"></i>
                                        {{$masjid->address}}
                                    </div>        
                    </div>
                </div>
            </div>
              
                </div>
        </div>

        @can('isAdmin')
        <div class="bg-gray-50 border border-gray-200 rounded">
        <div class="mt-4 p-2 flex space-x-6"><a href="/masajid_database/{{$masjid->id}}/edit_masjid"><x-primary-button class="ml-3">
            <i class="fa-solid fa-pencil">  {{ __('') }} </i>
        </x-primary-button></a>
        @endcan

        @can('isAdmin')
        <form method="POST" action="/masajid_database/{{$masjid->id}}">
            @csrf
            @method('DELETE')
            <x-danger-button onclick="return confirm('Are you sure you want to delete this record?')">
            <i class="fa-solid fa-trash"> 
                 {{ __('') }}
                 </i>
        </x-danger-button> 
</form>

{{-- <x-primary-button class="ml-3" onclick="window.print()">
    <i class="fa-solid fa-download">  {{ __('') }} </i>
</x-primary-button> --}}
    
    </div>


        </div>
        @endcan
    </div>
    
</x-app-layout>
