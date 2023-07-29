@extends("layouts.app")

@section("content")
    <div class="max-w-2xl mx-auto mb-8">
        <div class="bg-white p-6 rounded-lg shadow-md relative">
            <div class="absolute right-5 top-5">
                <!-- Display Edit Button for the authenticated user's own profile -->
                @auth
                    @if(auth()->user()->id === $developerProfile->user_id)
                        <a href="{{ url('/developer-profiles/' . auth()->user()->developerProfile->id . '/edit') }}" class="inline-block px-4 py-2 bg-customBlue hover:bg-customDarkBlue text-white text-sm rounded-lg">Edit</a>
                    @endif
                @endauth
            </div>

            <div>
                @if ($developerProfile->image)
                    <img class="rounded w-32 h-32 border mb-5 my-4" src="{{$developerProfile->image}}" alt="Extra large avatar">
                @else
                    <img class="rounded w-32 h-32 border mb-3" id="profileImage" src="{{ asset('img/profile-placeholder.png') }}" alt="Extra large avatar">
                @endif

                <h1 class="text-3xl font-bold text-left mb-5">{{ $developerProfile->hero }}</h1>

                <div class="sm:grid sm:grid-cols-2 flex flex-col">
                        <!-- Location -->
                        <div class="mb-4">
                            <h3 class="text-lg mb-1">Location</h3>
                            <p><i class="fa-solid fa-location-dot text-gray-400 mr-2"></i>{{ $developerProfile->city }}, {{ $developerProfile->state }}</p>
                        </div>

                        <!-- Search Status -->
                        <div class="mb-4">
                            <h3 class="text-lg">Search Status</h3>
                            <p><i class="fa-solid fa-circle-check text-gray-400 mr-2"></i>{{ ucfirst($developerProfile->search_status) }}</p>
                        </div>

                        <!-- Preferred Positions -->
                        <div class="mb-4">
                            <h3 class="text-lg mb-1">Preferred Positions</h3>
                            @if($developerProfile->part_time)
                                <p class="text-gray-800"><i class="fa-solid fa-circle-check text-gray-400 mr-2"></i>Part-time</p>
                            @endif
                            @if($developerProfile->full_time)
                                <p class="text-gray-800"><i class="fa-solid fa-circle-check text-gray-400 mr-2"></i>Full-time</p>
                            @endif
                            @if($developerProfile->contract)
                                <p class="text-gray-800"><i class="fa-solid fa-circle-check text-gray-400 mr-2"></i>Contract</p>
                            @endif
                        </div>

                        <!-- Role Level -->
                        <div class="mb-4">
                            <h3 class="text-lg mb-1">Role Level</h3>
                            <p class="text-gray-800 mb-2"><i class="fa-solid fa-circle-check text-gray-400 mr-2"></i>{{ ucfirst($developerProfile->role_level) }}</p>
                        </div>

                    </div>

                    <div class="mb-4">
                    <h3 class="text-lg mb-1">Bio</h3>
                    <p class="text-gray-800 mb-2">{{ $developerProfile->bio }}</p>
                </div>

                <h3 class="text-lg mb-1">Social Links</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        @if($developerProfile->website)
                            <p class="text-gray-800 mb-2"><a href="{{ $developerProfile->website }}" class="text-gray-500"><i class="fa-solid fa-globe mr-1"></i> {{ $developerProfile->website }}</a></p>
                        @endif

                        @if($developerProfile->github)
                            <p class="text-gray-800 mb-2"><a href="https://github.com/{{ $developerProfile->github }}" class="text-gray-500"><i class="fa-brands fa-github mr-1"></i>  {{ $developerProfile->github }}</a></p>
                        @endif

                        @if($developerProfile->stack_overflow)
                            <p class="text-gray-800 mb-2"><a href="https://stackoverflow.com/users/{{ $developerProfile->stack_overflow }}" class="text-gray-500"><i class="fa-brands fa-stack-overflow mr-1"></i> {{ $developerProfile->stack_overflow }}</a></p>
                        @endif

                        @if($developerProfile->linkedin)
                            <p class="text-gray-800 mb-2"><a href="https://www.linkedin.com/in/{{ $developerProfile->linkedin }}" class="text-gray-500"><i class="fa-brands fa-linkedin mr-1"></i> {{ $developerProfile->linkedin }}</a></p>
                        @endif

                        @if($developerProfile->twitter)
                            <p class="text-gray-800 mb-2"><a href="https://twitter.com/{{ $developerProfile->twitter }}" class="text-gray-500"><i class="fa-brands fa-twitter mr-1"></i> {{ $developerProfile->twitter }}</a></p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
