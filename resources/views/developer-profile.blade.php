@extends("layouts.app")

@section("content")
    <div class="max-w-2xl mx-auto">
        <!-- Display Developer Profile Information -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold">{{ $developerProfile->hero }}</h1>

                <!-- Display Edit Button for the authenticated user's own profile -->
                @auth
                    @if(auth()->user()->id === $developerProfile->user_id)
                        <a href="{{ url('/developer-profiles/' . auth()->user()->developerProfile->id . '/edit') }}" class="inline-block px-4 py-2 bg-customBlue hover:bg-customDarkBlue text-white text-sm rounded-lg">Edit</a>
                    @endif
                @endauth
            </div>

            <div class="mb-4">
                <div class="mb-3">
                    <h3 class="text-lg mb-1">Location</h3>
                    <p><i class="fa-solid fa-location-dot text-gray-400 mr-2"></i>{{ $developerProfile->city }}, {{ $developerProfile->state }}</p>
                </div>

                <div class="mb-3">
                    <h3 class="text-lg">Search Status</h3>
                    <p><i class="fa-solid fa-circle-check text-gray-400 mr-2"></i>{{ ucfirst($developerProfile->search_status) }}</p>
                </div>

                <div class="mb-4">
                    <h3 class="text-lg mb-1">Role Level</h3>
                    <p class="text-gray-800 mb-2"><i class="fa-solid fa-circle-check text-gray-400 mr-2"></i>{{ ucfirst($developerProfile->role_level) }}</p>
                </div>

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

                <div class="mb-4">
                    <h3 class="text-lg mb-1">Bio</h3>
                    <p class="text-gray-800 mb-2">{{ $developerProfile->bio }}</p>
                </div>

                <h3 class="text-lg mb-1">Socials</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        @if($developerProfile->website)
                            <p class="text-gray-800 mb-2">Website: <a href="{{ $developerProfile->website }}" class="text-blue-600">{{ $developerProfile->website }}</a></p>
                        @endif

                        @if($developerProfile->github)
                            <p class="text-gray-800 mb-2">GitHub: <a href="https://github.com/{{ $developerProfile->github }}" class="text-blue-600">{{ $developerProfile->github }}</a></p>
                        @endif

                        @if($developerProfile->stack_overflow)
                            <p class="text-gray-800 mb-2">Stack Overflow: <a href="{{ $developerProfile->stack_overflow }}" class="text-blue-600">{{ $developerProfile->stack_overflow }}</a></p>
                        @endif

                        @if($developerProfile->linkedin)
                            <p class="text-gray-800 mb-2">LinkedIn: <a href="{{ $developerProfile->linkedin }}" class="text-blue-600">{{ $developerProfile->linkedin }}</a></p>
                        @endif

                        @if($developerProfile->twitter)
                            <p class="text-gray-800 mb-2">Twitter: <a href="https://twitter.com/{{ $developerProfile->twitter }}" class="text-blue-600">{{ $developerProfile->twitter }}</a></p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
