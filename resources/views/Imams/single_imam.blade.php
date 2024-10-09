<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                  
            
            <div class="bg-gray-50 border border-gray-200 rounded p-6">
                <div class="flex">
                    <div class="">

                        <div class="grid grid-flow-col col-md-6 text-right">
                            @if ($imam->photo)
                            <img class="w-48 mr-6 md:block" src="{{ Storage::disk('s3')->url($imam->photo) }}" alt="" />
                            @endif
                        </div>
                            <div>
                                <h5 class="text-base">
                                   ID: {{$imam->id}}
                                </h5>

                                @if($user)
                                IMAM USER ID:<a href="/users_database/{{$user->id}}/edit_user"> {{$user->id}}</a>
                                @else
                                No User is Associated with this Husband
                                @endif
                       
                        <div>
                        <h5 class="text-base">
                           Imam Fullname: {{$imam->name}}
                        </h5>
                    
                        <div class="text-xl mb-4">
                            <h5 class="text-base">
                           Imam Phone Number: {{$imam->phone}}
                            </h5>
                            
                        <div class="text-xl mb-4">
                            <h5 class="text-base">
                           Imam Email: {{$imam->email}}
                            </h5>

                            @if($masajid->count() > 0)
                            <div class="text-xl mb-4">
                                <h5 class="text-base">
                               Masajid(Mosque):
                               @foreach($masajid as $masjid) 
                               <a href="{{ url('/masajid_database/' . $masjid->id) }}">{{$masjid->name}}</a>
                               @endforeach
                                </h5>
                                    @else
                                        <h5>No Masjid Assigned</h5>
                                        @endif

                            <div class="text-lg mt-4">
                                <i class="fa-solid fa-location-dot"></i>
                                {{$imam->address}}
                                
                            </div>
              
                </div>
        </div>

        @can('isAdmin')
        <div class="bg-gray-50 border border-gray-200 rounded">
        <div class="mt-4 p-2 flex space-x-6"><a href="/imams_database/{{$imam->id}}/edit_imam"><x-primary-button class="ml-3">
            <i class="fa-solid fa-pencil">  {{ __('') }} </i>
        </x-primary-button></a>
        @endcan

        @can('isAdmin')
        <form method="POST" action="/imams_database/{{$imam->id}}">
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
