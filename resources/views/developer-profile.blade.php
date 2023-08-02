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
                    <img class="rounded w-24 h-24 md:w-32 md:h-32 border mb-5" src="{{$developerProfile->image}}" alt="Extra large avatar">
                @else
                    <img class="rounded w-25 h-25 md:w-32 md:h-32 border mb-3" id="profileImage" src="{{ asset('img/profile-placeholder.png') }}" alt="Extra large avatar">
                @endif

                <h1 class="text-2xl md:text-3xl font-bold text-left mb-2">{{ $developerProfile->hero }}</h1>

                <div class="mb-4">
                    @if (auth()->user()?->companyProfile?->paid_subscription)
                        <p class="text-xl">{{ $developerProfile->name  }}</p>
                    @else
                        <span class="inline-block border-dashed border-2 border-gray-400 bg-gray-200 rounded-lg px-3 py-1.5">
                        <span class="inline-block pr-1">
                          <svg class="fill-current text-gray-500 w-3 h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M4 8V6a6 6 0 1 1 12 0v2h1a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2h1zm5 6.73V17h2v-2.27a2 2 0 1 0-2 0zM7 6v2h6V6a3 3 0 0 0-6 0z"></path>
                          </svg>
                        </span>
                        Private Info
                   </span>
                    @endif
                </div>

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

                <div class="mb-4" id="bio-container"></div>

                <h3 class="text-lg mb-1">Social Links</h3>

                @if (auth()->user()?->companyProfile?->paid_subscription)
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
                @else
                 <span class=" inline-block border-dashed border-2 border-gray-400 bg-gray-200 rounded-lg px-3 py-1.5">
                    <span class="inline-block pr-1">
                      <svg class="fill-current text-gray-500 w-3 h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M4 8V6a6 6 0 1 1 12 0v2h1a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2h1zm5 6.73V17h2v-2.27a2 2 0 1 0-2 0zM7 6v2h6V6a3 3 0 0 0-6 0z"></path>
                      </svg>
                    </span>
                    Private Info
                 </span>
                @endif
            </div>
        </div>
    </div>

    <script>
        // Get the bio content from the PHP variable
        const bioContent = `{!! $developerProfile->bio !!}`;

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
