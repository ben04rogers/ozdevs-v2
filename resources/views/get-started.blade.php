@extends("layouts.app")

@section("content")
    <div class="flex flex-col items-center justify-center">
        <h1 class="text-4xl font-bold mb-8">Get Started</h1>
        <div class="flex flex-col md:flex-row gap-4">
            <div class="w-full md:w-1/2">
                <div class="p-6 relative flex flex-col h-full overflow-hidden border border-gray-300 rounded-lg justify bg-white">
                    <div>
                        <h3 class="text-3xl md:text-3xl pb-3 text-gray-800">Developer</h3>
                        <ul class="md:text-lg pb-6 pl-1 text-gray-600">
                            <li class="pb-1">
                                <span class="inline-flex items-center justify-center flex-shrink-0 w-4 h-4 mr-1 text-white bg-green-500 rounded-full">
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                        <path d="M20 6L9 17l-5-5"></path>
                                    </svg>
                                </span>
                                <b>Free</b> dev profile.
                            </li>
                            <li class="pb-1">
                                <span class="inline-flex items-center justify-center flex-shrink-0 w-4 h-4 mr-1 text-white bg-green-500 rounded-full">
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                        <path d="M20 6L9 17l-5-5"></path>
                                    </svg>
                                </span>
                                <b>Free</b> job & project leads (<b>no fees</b>)
                            </li>
                            <li class="pb-1">
                                <span class="inline-flex items-center justify-center flex-shrink-0 w-4 h-4 mr-1 text-white bg-green-500 rounded-full">
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                        <path d="M20 6L9 17l-5-5"></path>
                                    </svg>
                                </span>
                                Reply to companies.
                            </li>
                        </ul>
                        <a href="{{ route('newDeveloperForm') }}" class="w-full lg:w-auto text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2.5 mb-2">
                            Create Developer Profile
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-1 inline-block" viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-1/2 mt-4 md:mt-0">
                <div class="p-6 relative flex flex-col h-full overflow-hidden border border-gray-300 rounded-lg justify bg-white">
                    <div>
                        <h3 class="text-3xl md:text-3xl pb-3 text-gray-800">Company</h3>
                        <ul class="md:text-lg pb-6 pl-1 text-gray-600">
                            <li class="pb-1">
                                <span class="inline-flex items-center justify-center flex-shrink-0 w-4 h-4 mr-1 text-white bg-green-500 rounded-full">
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                        <path d="M20 6L9 17l-5-5"></path>
                                    </svg>
                                </span>
                                <b>Free</b> company profile.
                            </li>
                            <li class="pb-1">
                                <span class="inline-flex items-center justify-center flex-shrink-0 w-4 h-4 mr-1 text-white bg-green-500 rounded-full">
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                        <path d="M20 6L9 17l-5-5"></path>
                                    </svg>
                                </span>
                                Access to a pool of talented developers.
                            </li>
                            <li class="pb-1">
                                <span class="inline-flex items-center justify-center flex-shrink-0 w-4 h-4 mr-1 text-white bg-green-500 rounded-full">
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                        <path d="M20 6L9 17l-5-5"></path>
                                    </svg>
                                </span>
                                Post job & project opportunities.
                            </li>
                        </ul>
                        <a href="" class="w-full lg:w-auto text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2.5 mb-2">
                            Create Company Profile
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-1 inline-block" viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
