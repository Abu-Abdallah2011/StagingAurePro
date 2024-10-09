<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                  
            
            <div class="bg-gray-50 border border-gray-200 rounded p-6">
                <div class="flex">
                    <div class="">

                        <div class="grid grid-flow-col col-md-6 text-right">
                            @if ($profile->photo)
                            {{-- <img class="w-48 mr-6 md:block" src="{{ Storage::disk('s3')->url($profile->photo) }}" alt="" /> --}}
                            @endif
                        </div>
                            <div>
                                <h5 class="text-base">
                                  Profile Id: {{$profile->id}}
                                </h5>

                                @if($users)
                                User Id:@can('isAdmin')<a href="/users_database/{{$users->id}}/edit_user">@endcan {{$users->id}}@can('isAdmin')</a>@endcan
                                @else
                                No User is Associated with this Profile
                                @endif
                       
                        <div>
                        <h5 class="text-base">
                           Fullname: {{$profile->first_name}} {{$profile->surname}}
                        </h5>

                        <div>
                            <h5 class="text-base">
                               Gender: {{$profile->gender}}
                            </h5>

                        <div class="text-xl mb-4">
                            <h5 class="text-base">
                           National Identity Number(NIN): {{$profile->nin}}
                            </h5>
                    
                        <div class="text-xl mb-4">
                            <h5 class="text-base">
                           Phone Number: {{$profile->phone}}
                            </h5>
                            
                        <div class="text-xl mb-4">
                            <h5 class="text-base">
                           Email: {{$profile->email}}
                            </h5>

                            @if($marriages->count() > 0)
                            <div class="text-xl mb-4">
                                <h5 class="text-base">
                               Marriages Dates:
                               @foreach($marriages as $marriage) 
                               <div>
                                <a href="{{ url('/marriages_database/' . $marriage->id) }}">
                               <x-primary-button>
                               {{$marriage->date}}
                               </x-primary-button>
                            </a>
                            </div>
                               @endforeach
                                </h5>
                                    @else
                                        <h5>No Marriage Assigned</h5>
                                        @endif

                            <div class="text-lg mt-4">
                                <i class="fa-solid fa-location-dot"></i>
                                {{$profile->address}}
                                
                            </div>
              
                </div>
        </div>

        @can('isAdmin')
        <div class="bg-gray-50 border border-gray-200 rounded">
        <div class="mt-4 p-2 flex space-x-6"><a href="/profiles_database/{{$profile->id}}/edit_profile"><x-primary-button class="ml-3">
            <i class="fa-solid fa-pencil">  {{ __('') }} </i>
        </x-primary-button></a>
        @endcan

        @can('isAdmin')
        <form method="POST" action="/profiles_database/{{$profile->id}}">
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
