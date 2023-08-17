@extends("layouts.app")

@section("content")
    <div class="max-w-5xl mx-auto mb-10">
        <div class="bg-white p-6 rounded-lg shadow-md relative">
            <div class="absolute right-5 top-5">
                <!-- Display Edit Button for the authenticated user's own profile -->
                @auth
                    @if(auth()->user()->id === $developerProfile->user_id)
                        <a href="{{ url('/developer-profiles/' . auth()->user()->developerProfile->id . '/edit') }}" class="inline-block px-4 py-2 bg-customBlue hover:bg-customDarkBlue text-white text-sm rounded-lg">Edit</a>
                    @endif
                @endauth
            </div>

            <div class="peer-focus:scale-75">
                @if ($developerProfile->image)
                    <img class="rounded w-24 h-24 md:w-32 md:h-32 border mb-5" src="{{$developerProfile->image}}" alt="Extra large avatar">
                @else
                    <img class="rounded w-24 h-24 md:w-32 md:h-32 border mb-3" id="profileImage" src="{{ asset('img/profile-placeholder.png') }}" alt="Extra large avatar">
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-x-4">
                <div class="col-span- md:col-span-2">
                    <h1 class="text-2xl md:text-3xl font-bold text-left mb-2">{{ $developerProfile->hero }}</h1>

                    <div class="mb-4">
                        @if (auth()->check() && $developerProfile && (auth()->user()->id === $developerProfile->user_id || (auth()->user()->companyProfile && auth()->user()->companyProfile->paid_subscription)))
                            <p class="text-xl">{{ $developerProfile->user->name  }}</p>
                        @endif
                    </div>

                    <div class="mb-4 rounded" id="bio-container"></div>

                    <div class="hidden md:block">
                        <h3 class="text-lg mb-1">Social Links</h3>
                        @if (auth()->check() && ($developerProfile->user_id === auth()->user()->id || (auth()->user()->companyProfile && auth()->user()->companyProfile->paid_subscription)))
                            <div class="grid gap-4">
                                <div>
                                    @if($developerProfile->website)
                                        <p class="text-gray-800 mb-2"><a href="https://{{ $developerProfile->website }}" class="text-gray-500 inline-flex items-center"><i class="fa-solid fa-globe mr-2"></i> https://{{ $developerProfile->website }}</a></p>
                                    @endif

                                    @if($developerProfile->github)
                                        <p class="text-gray-800 mb-2"><a href="https://github.com/{{ $developerProfile->github }}" class="text-gray-500 inline-flex items-center"><i class="fa-brands fa-github mr-2"></i> https://github.com/{{ $developerProfile->github }}</a></p>
                                    @endif

                                    @if($developerProfile->stack_overflow)
                                        <p class="text-gray-800 mb-2"><a href="https://stackoverflow.com/users/{{ $developerProfile->stack_overflow }}" class="text-gray-500 inline-flex items-center"><i class="fa-brands fa-stack-overflow mr-2"></i> https://stackoverflow.com/users/{{ $developerProfile->stack_overflow }}</a></p>
                                    @endif

                                    @if($developerProfile->linkedin)
                                        <p class="text-gray-800 mb-2"><a href="https://www.linkedin.com/in/{{ $developerProfile->linkedin }}" class="text-gray-500 inline-flex items-center"><i class="fa-brands fa-linkedin mr-2"></i> https://www.linkedin.com/in/{{ $developerProfile->linkedin }}</a></p>
                                    @endif

                                    @if($developerProfile->twitter)
                                        <p class="text-gray-800 mb-2"><a href="https://twitter.com/{{ $developerProfile->twitter }}" class="text-gray-500 inline-flex items-center"><i class="fa-brands fa-twitter mr-2"></i> https://twitter.com/{{ $developerProfile->twitter }}</a></p>
                                    @endif

                                    @if(!$developerProfile->website && !$developerProfile->github && !$developerProfile->stack_overflow && !$developerProfile->linkedin && !$developerProfile->twitter)
                                        <p class="text-gray-800 mb-2">No social links found.</p>
                                    @endif
                                </div>
                            </div>
                        @else
                            <span class="inline-block border-dashed border-2 border-gray-400 bg-gray-100 rounded-lg px-3 py-1.5 mb-5">
                                <span class="inline-block pr-1">
                                  <svg class="fill-current text-gray-500 w-3 h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M4 8V6a6 6 0 1 1 12 0v2h1a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2h1zm5 6.73V17h2v-2.27a2 2 0 1 0-2 0zM7 6v2h6V6a3 3 0 0 0-6 0z"></path>
                                  </svg>
                                 </span>
                                Private Information
                           </span>
                        @endif
                    </div>
                </div>
                <div class="col-span-1 md:col-span-1 border-2 border-customBlue rounded-lg" style="height: fit-content;">
                    <div class="flex flex-wrap flex-row items-start space-y-3 p-6">

                        @if(!auth()->user()?->companyProfile?->paid_subscription && $developerProfile->user_id !== auth()->user()?->id)
                            <a href="{{ route('pricing') }}" class="transition-all group duration-200 ease-in-out bg-gray-100 border-dashed border-2 border-gray-400 rounded-lg py-3 px-5 inline-flex items-center justify-start w-full">
                                <div class="z-10 text-left">
                                    <p class="mb-2 font-bold text-gray-500">Private Information</p>
                                    <p class="mb-2 text-gray-500">This information is only visible with a business subscription.</p>
                                    <p class="text-sm font-bold text-gray-500">Subscribe →</p>
                                </div>
                            </a>
                        @endif
                        <div class="w-full">
                            <h5 class="font-medium text-black mb-1">Search status</h5>
                            <p class="text-gray-600 text-base inline-flex items-center">
                                <i class="fa-solid fa-circle-check text-gray-400 mr-2"></i><span>{{ ucfirst($developerProfile->search_status) }}</span>
                            </p>
                        </div>
                        <div class="w-full">
                            <h5 class="font-medium text-black mb-1">Experience level</h5>
                            <p class="text-gray-600 text-base inline-flex items-center">
                                <i class="fa-solid fa-circle-check text-gray-400 mr-2"></i><span>{{ ucfirst($developerProfile->role_level) }}</span>
                            </p>
                        </div>
                        <div class="w-full">
                            <h5 class="font-medium text-black mb-1">Location</h5>
                            <p class="text-gray-600 text-base inline-flex items-center">
                                <i class="fa-solid fa-location-dot text-gray-400 mr-2"></i>
                                <span>{{ $developerProfile->city }}, {{ $developerProfile->state }}</span>
                            </p>
                        </div>
                        <div class="w-full">
                            <h5 class="font-medium text-black mb-1">Preferred Positions</h5>
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
                    </div>
                    <div class="flex items-center">
                        @if(auth()->user()?->companyProfile?->paid_subscription)
                            <a href="{{ url('/messages/' . $developerProfile->user_id) }}" class="text-base font-semibold text-white bg-customBlue leading-loose relative flex items-center justify-center py-1 px-4 mx-auto w-full">
                                <i class="fas fa-comment-dots mr-1"></i> Message
                            </a>
                        @endif

                        @if (!auth()->user()?->companyProfile?->paid_subscription)
                            <a href="{{ route('pricing') }}" class="text-base font-semibold text-white bg-customBlue leading-loose relative flex items-center justify-center py-1 px-4 mx-auto w-full">
                                Subscribe to hire →
                            </a>
                        @endif
                    </div>
                </div>

                <div class="block md:hidden mt-4">
                    <h3 class="text-lg mb-1">Social Links</h3>
                    @if (auth()->check() && ($developerProfile->user_id === auth()->user()->id || (auth()->user()->companyProfile && auth()->user()->companyProfile->paid_subscription)))
                        <div class="grid gap-4">
                            <div>
                                @if($developerProfile->website)
                                    <p class="text-gray-800 mb-2"><a href="https://{{ $developerProfile->website }}" class="text-gray-500 inline-flex items-center"><i class="fa-solid fa-globe mr-2"></i> https://{{ $developerProfile->website }}</a></p>
                                @endif

                                @if($developerProfile->github)
                                    <p class="text-gray-800 mb-2"><a href="https://github.com/{{ $developerProfile->github }}" class="text-gray-500 inline-flex items-center"><i class="fa-brands fa-github mr-2"></i> https://github.com/{{ $developerProfile->github }}</a></p>
                                @endif

                                @if($developerProfile->stack_overflow)
                                    <p class="text-gray-800 mb-2"><a href="https://stackoverflow.com/users/{{ $developerProfile->stack_overflow }}" class="text-gray-500 inline-flex items-center"><i class="fa-brands fa-stack-overflow mr-2"></i> https://stackoverflow.com/users/{{ $developerProfile->stack_overflow }}</a></p>
                                @endif

                                @if($developerProfile->linkedin)
                                    <p class="text-gray-800 mb-2"><a href="https://www.linkedin.com/in/{{ $developerProfile->linkedin }}" class="text-gray-500 inline-flex items-center"><i class="fa-brands fa-linkedin mr-2"></i> https://www.linkedin.com/in/{{ $developerProfile->linkedin }}</a></p>
                                @endif

                                @if($developerProfile->twitter)
                                    <p class="text-gray-800 mb-2"><a href="https://twitter.com/{{ $developerProfile->twitter }}" class="text-gray-500 inline-flex items-center"><i class="fa-brands fa-twitter mr-2"></i> https://twitter.com/{{ $developerProfile->twitter }}</a></p>
                                @endif

                                @if(!$developerProfile->website && !$developerProfile->github && !$developerProfile->stack_overflow && !$developerProfile->linkedin && !$developerProfile->twitter)
                                    <p class="text-gray-800 mb-2">No social links found.</p>
                                @endif
                            </div>
                        </div>
                    @else
                        <span class="inline-block border-dashed border-2 border-gray-400 bg-gray-100 rounded-lg px-3 py-1.5 mb-5">
                                <span class="inline-block pr-1">
                                  <svg class="fill-current text-gray-500 w-3 h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M4 8V6a6 6 0 1 1 12 0v2h1a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2h1zm5 6.73V17h2v-2.27a2 2 0 1 0-2 0zM7 6v2h6V6a3 3 0 0 0-6 0z"></path>
                                  </svg>
                                 </span>
                                Private Information
                           </span>
                    @endif
                </div>
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
