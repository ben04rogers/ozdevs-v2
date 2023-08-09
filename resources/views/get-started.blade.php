@extends("layouts.app")

@section("content")
    <div class="container mx-auto px-2 md:px-4">
        <h1 class="text-3xl text-center font-bold mb-4 md:mb-8">What brings you to OzDevs?</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white rounded-lg shadow-md p-5 md:p-8">
                <h3 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4">Developer</h3>
                <ul class="text-lg text-gray-600 mb-6">
                    <li class="mb-3 flex items-center">
                        <span class="inline-flex items-center justify-center flex-shrink-0 w-4 h-4 mr-1 text-white bg-green-500 rounded-full">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                <path d="M20 6L9 17l-5-5"></path>
                            </svg>
                        </span>
                        <b class="mr-1">Free</b> dev profile.
                    </li>
                    <li class="mb-3 flex items-center flex-wrap">
                        <span class="inline-flex items-center justify-center flex-shrink-0 w-4 h-4 mr-1 text-white bg-green-500 rounded-full">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                <path d="M20 6L9 17l-5-5"></path>
                            </svg>
                        </span>
                        <b class="mr-1">Free</b> job & project leads (<b>no fees</b>).
                    </li>
                    <li class="flex items-center flex-wrap">
                         <span class="inline-flex items-center justify-center flex-shrink-0 w-4 h-4 mr-1 text-white bg-green-500 rounded-full">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                <path d="M20 6L9 17l-5-5"></path>
                            </svg>
                        </span>
                        Reply to companies.
                    </li>
                </ul>
                <a href="{{ route('newDeveloperForm') }}" class="block text-white bg-customBlue hover:bg-customDarkBlue focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center" style="width: fit-content;">
                    Create Developer Profile
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-1 inline-block" viewBox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            <div class="bg-white rounded-lg shadow-md p-5 md:p-8">
                <h3 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4">Company</h3>
                <ul class="text-lg text-gray-600 mb-6">
                    <li class="mb-3 items-center block">
                        <span class="inline-flex items-center justify-center flex-shrink-0 w-4 h-4 mr-1 text-white bg-green-500 rounded-full">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                <path d="M20 6L9 17l-5-5"></path>
                            </svg>
                        </span>
                        <b class="mr-1">Free</b> company profile.
                    </li>
                    <li class="mb-3 items-center block">
                         <span class="inline-flex items-center justify-center flex-shrink-0 w-4 h-4 mr-1 text-white bg-green-500 rounded-full">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                <path d="M20 6L9 17l-5-5"></path>
                            </svg>
                        </span>
                        Access to a pool of talented developers.
                    </li>
                    <li class="items-center block">
                         <span class="inline-flex items-center justify-center flex-shrink-0 w-4 h-4 mr-1 text-white bg-green-500 rounded-full">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                <path d="M20 6L9 17l-5-5"></path>
                            </svg>
                        </span>
                        Post job & project opportunities.
                    </li>
                </ul>
                <a href="{{ route('newCompanyForm') }}" class="block text-white bg-customBlue hover:bg-customDarkBlue focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center" style="width: fit-content;">
                    Create Company Profile
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-1 inline-block" viewBox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
@endsection

