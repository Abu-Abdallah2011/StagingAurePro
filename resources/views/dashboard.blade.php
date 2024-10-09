<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
            @if($profile && $profile->gender == 'MALE' && $husbandMarriages->where('active', true)->count() < 4)
            <a href="marriages_reg_form">
                <x-primary-button class="absolute top-15 right-9 bg-green-500">
                    Marriage Apply
                </x-primary-button> 
                </a>

                @elseif($profile && $profile->gender == 'FEMALE' && $wifeMarriages->where('active', true)->count() < 1)
                <a href="marriages_reg_form">
                    <x-primary-button class="absolute top-15 right-9 bg-green-500">
                        Marriage Apply
                    </x-primary-button> 
                    </a>
                @endif
        </h2>
    </x-slot>

    @if($profile)
     {{-- the dashboard --}}
                    <div class="dark:bg-gray-800 overflow-hidden shadow-sm">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                    <body class="bg-gray-100 dark:bg-gray-900">
                        <div class="min-h-screen flex flex-col">
                            <!-- Session Status -->
                        <x-success-status class="mb-4" :status="session('message')" />

                        @foreach ($profile->unreadNotifications as $notification)
                       <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 text-red-500">{{ $notification->data['message'] }} 
                        <a href="{{ route('viewMarriage', ['id' => $notification->data['marriage_id']]) }}" class="btn btn-success">
                        Check Details
                    </a></div>
                        @endforeach
                    
                            <!-- Main Content -->
                            <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-8">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                    <!-- Card: Marriages -->
                                    <a href="{{ url('/profileMarriages/' . $profile->id) }}">
                                    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0">
                                                <i class="fas fa-heart fa-2x text-danger"></i>
                                            </div>
                                            <div class="ml-4">
                                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-900">Auratayya</h3>
                                                <p class="text-2xl font-bold text-gray-900 dark:text-gray-900">Adadin Aurenka/ki: 
                                                    @if($husbandMarriages && $husbandMarriages->count() > 0)
                                                    {{ $husbandMarriages->count() }}
                                                    @else
                                                    {{ $wifeMarriages->count() }}
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                    
                                    <!-- Card: Wakilci -->
                                    <a href="{{ url('/wakilMarriages/' . $profile->id) }}">
                                    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0">
                                                <i class="fas fa-handshake fa-2x text-success"></i>
                                            </div>
                                            <div class="ml-4">
                                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-900">Wakilci</h3>
                                                <p class="text-2xl font-bold text-gray-900 dark:text-gray-900">Adadin Auren da ka Karba: {{ $profile->wakil->count() }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                    
                                    <!-- Card Template For Profile -->
                                    <a href="{{ url('/profiles_database/' . $profile->id) }}">
                                    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0">
                                                <i class="fas fa-user fa-2x text-warning"></i>
                                            </div>
                                            <div class="ml-4">
                                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-900">Bio Data</h3>
                                                <p class="text-2xl font-bold text-gray-900 dark:text-gray-900">Profile Id: {{ $profile->id }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    </a>

                                    <!-- Card: Auaratayyan da akayi  Walicci -->
                                    <a href="{{  url('/waliyyMarriages/' . $profile->id) }}">
                                    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0">
                                                <i class="fas fa-user-shield fa-2x text-primary"></i>
                                            </div>
                                            <div class="ml-4">
                                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-900">Waliyyi</h3>
                                                <p class="text-2xl font-bold text-gray-900 dark:text-gray-900">Adadin Auren Da Ka Bayar: {{ $profile->waliyy->count() }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                                <!-- Card: Masallatai -->
                                <a href="{{ url('/profileMasajidDatabase/' . $profile->id) }}">
                                    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0">
                                                <i class="fas fa-mosque fa-2x text-success"></i>
                                            </div>
                                            <div class="ml-4">
                                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-900">Masallatai</h3>
                                                <p class="text-2xl font-bold text-gray-900 dark:text-gray-900">Adadin Masallatai: {{ $masajid->count() }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                                <!-- Card: Marriage Certificates -->
                                <a href="attendance/show">
                                    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0">
                                                <i class="fas fa-certificate fa-2x text-warning"></i>
                                            </div>
                                            <div class="ml-4">
                                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-900">Shaida</h3>
                                                <p class="text-2xl font-bold text-gray-900 dark:text-gray-900">Takardun Shaidan Aure: 00</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                    
                                </div>

                                
                                </div>
                                </div>

                                @else
                                <div class="text-2xl font-bold text-center mt-4">
                                WELCOME DEAR USER! CREATE YOUR PROFILE <a href="profiles_reg_form"><span class="text-blue-500">HERE.</span></a>
                                </div>
                                @endif

</x-app-layout>
