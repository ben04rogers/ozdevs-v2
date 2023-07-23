@extends("layouts.app")

@section("content")
    <div class="max-w-2xl mx-auto">
        <!-- Display Developer Profile Information -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-4">
                <h1 class="text-3xl font-bold mb-8 text-center">{{ $developerProfile->name }}</h1>
                <p class="text-gray-800 mb-4">City: {{ $developerProfile->city }}</p>
                <p class="text-gray-800 mb-4">State: {{ $developerProfile->state }}</p>
                <p class="text-gray-800 mb-4">Country: {{ $developerProfile->country }}</p>
                <p class="text-gray-800 mb-4">Bio: {{ $developerProfile->bio }}</p>
                <p class="text-gray-800 mb-4">Search Status: {{ $developerProfile->search_status }}</p>
                <p class="text-gray-800 mb-4">Role Level: {{ $developerProfile->role_level }}</p>
                <p class="text-gray-800 mb-4">Employment Type:</p>
                <ul class="list-disc pl-6 mb-4">
                    @if($developerProfile->part_time)
                        <li>Part Time</li>
                    @endif
                    @if($developerProfile->full_time)
                        <li>Full Time</li>
                    @endif
                    @if($developerProfile->contract)
                        <li>Contract</li>
                    @endif
                </ul>
                <p class="text-gray-800 mb-4">Website: {{ $developerProfile->website }}</p>
                <p class="text-gray-800 mb-4">GitHub: {{ $developerProfile->github }}</p>
                <p class="text-gray-800 mb-4">Stack Overflow: {{ $developerProfile->stack_overflow }}</p>
                <p class="text-gray-800 mb-4">LinkedIn: {{ $developerProfile->linkedin }}</p>
                <p class="text-gray-800 mb-4">Twitter: {{ $developerProfile->twitter }}</p>
                <p class="text-gray-800 mb-4">Email Notifications: {{ $developerProfile->email_notifications ? 'Yes' : 'No' }}</p>
            </div>

            <!-- Display Edit Button for the authenticated user's own profile -->
            @auth
                @if(auth()->user()->id === $developerProfile->user_id)
                    <a href="{{ url('/developer-profiles/' . auth()->user()->id . '/edit') }}" class="inline-block px-4 py-2 bg-customBlue hover:bg-customDarkBlue text-white rounded-lg mt-4">Edit</a>
                @endif
            @endauth
        </div>
    </div>
@endsection
