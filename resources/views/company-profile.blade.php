@extends("layouts.app")

@section("content")
    <div class="max-w-2xl mx-auto">
        <div class="bg-white p-6 rounded-lg shadow-md relative">
            <div class="absolute right-5 top-5">
                <!-- Display Edit Button for the authenticated user's own profile -->
                @auth
                    @if(auth()->user()->id === $companyProfile->user_id)
                        <a href="{{ url('/company-profiles/' . auth()->user()->companyProfile->id . '/edit') }}" class="inline-block px-4 py-2 bg-customBlue hover:bg-customDarkBlue text-white text-sm rounded-lg">Edit</a>
                    @endif
                @endauth
            </div>

            <div class="mb-4">
                @if ($companyProfile->image)
                    <img class="rounded h-24 w-auto md:h-32 border mb-3" src="{{$companyProfile->image}}" alt="Extra large avatar">
                @else
                    <img class="rounded h-24 w-auto md:h-32 border mb-3" id="profileImage" src="{{ asset('img/profile-placeholder.png') }}" alt="Extra large avatar">
                @endif

                <h1 class="text-2xl md:text-3xl font-bold text-left mb-2">{{ $companyProfile->company_name }}</h1>

                <div class="mb-4" id="bio-container"></div>

                <h3 class="text-lg mb-1">Website</h3>
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
    <script>
        // Get the bio content from the PHP variable
        const bioContent = `{!! $companyProfile->bio !!}`;

        // Create the Shadow DOM container
        const bioContainer = document.getElementById('bio-container');
        const shadow = bioContainer.attachShadow({ mode: 'open' });

        // Create a new paragraph element to hold the bio content
        const bioParagraph = document.createElement('p');
        bioParagraph.classList.add('text-gray-800', 'mb-2');
        bioParagraph.innerHTML = bioContent;

        // Append the bio paragraph to the Shadow DOM
        shadow.appendChild(bioParagraph);
    </script>
@endsection
