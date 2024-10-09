<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                  
            
            <div class="bg-gray-50 border border-gray-200 rounded p-6">
                <div class="flex">
                    <div class="">

                        <div class="grid grid-flow-col col-md-6 text-right">
                            @if ($marriage->photo)
                            <img class="w-48 mr-6 md:block" src="{{ Storage::disk('s3')->url($marriage->photo) }}" alt="" />
                            @endif
                        </div>
                            <div>
                                <h5 class="text-base">
                                   ID: {{$marriage->id}}
                                </h5>

                                @if($husband)
                            <div>
                            <h5 class="text-base">
                                Husband Name: <a href="{{ url('/profiles_database/' . $husband->id) }}">{{$husband->first_name}} {{$husband->surname}}</a>
                            </h5>
                            @else
                            <div>
                            No Husband attached to this Marriage
                        </div>
                            @endif

                            @if($wife)
                            <div>
                            <h5 class="text-base">
                                Wife Name: <a href="{{ url('/profiles_database/' . $wife->id) }}">{{$wife->first_name}} {{$wife->surname}}</a>
                            </h5>
                                @else
                                <div>
                            No Wife attached to this Marriage
                        </div>
                            @endif

                                @if($waliyy)
                                <div>
                                <h5 class="text-base">
                                    Waliyy Name: <a href="{{ url('/profiles_database/' . $waliyy->id) }}">{{$waliyy->first_name}} {{$waliyy->surname}}</a>
                                </h5>
                                @else
                                <div>
                            No Waliyy attached to this Marriage
                        </div>
                            @endif

                            @if($wakil)
                                <div>
                                    <h5 class="text-base">
                                        Wakil Name: <a href="{{ url('/profiles_database/' . $wakil->id) }}">{{$wakil->first_name}} {{$wakil->surname}}</a>
                                    </h5>
                                    @else
                                    <div>
                            No Wakil attached to this Marriage
                        </div>
                            @endif
                        <div>
                        <h5 class="text-base">
                           Date: {{$marriage->date}}
                        </h5>
                    
                        <div class="text-xl mb-4">
                            <h5 class="text-base">
                            Time: {{$marriage->time}}
                            </h5>
                            
                        <div class="text-xl mb-4">
                            <h5 class="text-base">
                            Dowry: {{$marriage->dowry}}
                            </h5>
                            <div class="text-xl mb-4">
                                <h5 class="text-base">
                                Dowry Status: {{$marriage->dowry_status}}
                                </h5>
                                <div class="text-xl mb-4">
                                    <h5 class="text-base">
                                    Husband Test: {{$marriage->husband_test}}
                                    </h5>
                                    <div class="text-xl mb-4">
                                        <h5 class="text-base">
                                        Wife Test: {{$marriage->wife_test}}
                                        </h5>
                            <div class="text-lg mt-4">
                                <i class="fa-solid fa-location-dot"></i>
                                {{$marriage->venue}}
                                
                            </div>
              
                </div>
        </div>

        {{-- Approve Marriage --}}
        @if ($approvedBy)
            <p class="text-green-500"><strong>Approved by:</strong> {{ $approvedBy->first_name }} {{ $approvedBy->surname }}</p>
        @elseif (Gate::allows('activate', $marriage))
            <form action="{{ route('approveMarriage', ['marriageId' => $marriage->id]) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">Approve Marriage</button>
            </form>
            @else
        <div class="text-red-500">This marriage has not Been Approved.</div>
        @endif

        {{-- Activate Marriage --}}
    @if($marriage->status == 'approved' && $marriage->active == false)
    @can('activate', $marriage)
        <form action="{{ route('marriages.activate', $marriage->id) }}" method="POST">
            @csrf
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
                Activate Marriage
            </button>
        </form>
    @endcan
    @elseif($marriage->active == false)
        <div class="text-red-500">This marriage has not Been Acivated.</div>

        @else
        <span class="text-green-500"><strong>Activated by:</strong> {{ $activatedBy->first_name }} {{ $activatedBy->surname }} </span>
    @endif

    @if($marriage->active == true)
    @can('isAdmin')
    <form action="{{ route('marriages.deactivate', $marriage->id) }}" method="POST">
        @csrf
        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">
            De-activate Marriage
        </button>
    </form>
    @endcan

    @elseif($marriage->active == false && $marriage->deactivated_by)
    <div class="text-red-500"><strong>De-Activated by:</strong> {{ $deactivatedBy->first_name }} {{ $deactivatedBy->surname }} </div>
    @endif

        <div class="mt-4">Contact the Leadership of Your Venue:</div> 
        @if($marriage->masjid)
        <div><i class="fas fa-phone"></i> {{ $marriage->masjid->chairman->phone }}</div>
        @endif
        @if($marriage->masjid)
        <div><i class="fas fa-phone"></i> {{ $marriage->masjid->imam->phone }}</div>
        @endif
        @if($marriage->masjid)
        <div><i class="fas fa-phone"></i> {{ $marriage->masjid->muazzin->phone }}</div>
        @endif

        @can('isAdmin')
        <div class="bg-gray-50 border border-gray-200 rounded">
        <div class="mt-4 p-2 flex space-x-6"><a href="/marriages_database/{{$marriage->id}}/edit_marriage"><x-primary-button class="ml-3">
            <i class="fa-solid fa-pencil">  {{ __('') }} </i>
        </x-primary-button></a>
        @endcan

        @if($marriage->active == false && !Gate::allows('isAdmin'))
        <div class="bg-gray-50 border border-gray-200 rounded">
            <div class="mt-4 p-2 flex space-x-6"><a href="/marriages_database/{{$marriage->id}}/edit_marriage"><x-primary-button class="ml-3">
                <i class="fa-solid fa-pencil">  {{ __('') }} </i>
            </x-primary-button></a>
            @endif

        @can('isAdmin')
        <form method="POST" action="/marriages_database/{{$marriage->id}}">
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
