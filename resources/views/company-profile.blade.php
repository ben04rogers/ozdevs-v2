@extends("layouts.app")

@section("content")
    <div class="max-w-2xl mx-auto">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold">{{ $companyProfile->company_name }}</h1>

                <!-- Display Edit Button for the authenticated user's own profile -->
                @auth
                    @if(auth()->user()->id === $companyProfile->user_id)
                        <a href="" class="inline-block px-4 py-2 bg-customBlue hover:bg-customDarkBlue text-white text-sm rounded-lg">Edit</a>
                    @endif
                @endauth
            </div>

            <div class="mb-4">
                <div class="mb-4">
                    <h3 class="text-lg mb-1">Bio</h3>
                    <p class="text-gray-800 mb-2">{{ $companyProfile->bio }}</p>
                </div>

                <h3 class="text-lg mb-1">Social Links</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        @if($companyProfile->website)
                            <p class="text-gray-800 mb-2"><a href="{{ $companyProfile->website }}" class="text-gray-500"><i class="fa-solid fa-globe mr-1"></i> {{ $companyProfile->website }}</a></p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
