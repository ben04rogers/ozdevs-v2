@extends("layouts.app")

@section("content")
    <div class="container mx-auto mt-10">
        <h2 class="text-2xl lg:text-3xl mb-5 font-bold">Find developers in Australia</h2>

        <div class="flex justify-between mb-2">
            <div class="flex justify-end block lg:hidden">
                <button class="flex items-center justify-center text-white bg-customBlue hover:bg-customDarkBlue focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-3 py-1.5 mr-2 mb-2 dark:bg-gray-700 dark:hover:bg-gray-800 focus:outline-none dark:focus:ring-gray-800" type="button" data-drawer-target="drawer-right-example" data-drawer-show="drawer-right-example" data-drawer-placement="right" aria-controls="drawer-right-example">
                    Filters
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="white" aria-hidden="true">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- drawer component -->
        <div id="drawer-right-example" class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-80 dark:bg-gray-800 z-50" tabindex="-1" aria-labelledby="drawer-right-label">
            <form action="{{ route('developers') }}" method="GET">
            <h5 id="drawer-right-label" class="inline-flex items-center mb-4 text-base font-bold text-gray-500 dark:text-gray-400">
                Filters
            </h5>
            <button type="button" data-drawer-hide="drawer-right-example" aria-controls="drawer-right-example" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 right-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close menu</span>
            </button>

            <!-- Filters content -->
            <div class="mb-4">
                <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                <input type="text" id="search" class="mt-1 px-3 py-2 border border-gray-300 rounded-md w-full" name="search" value="{{ request('search') }}">
            </div>

            <!-- Filter by state -->
            <x-state-select selectedState="{{ request('state') }}" />

            <div class="mb-4">
                <label for="experience" class="block text-sm font-medium text-gray-700">Experience Level</label>
                <select id="experience" class="mt-1 px-3 py-2 border border-gray-300 rounded-md w-full" name="experience_level">
                    <option value="">All Experience Levels</option>
                    <option value="junior" {{ request('experience_level') === 'junior' ? 'selected' : '' }}>Junior</option>
                    <option value="mid" {{ request('experience_level') === 'mid' ? 'selected' : '' }}>Mid</option>
                    <option value="senior" {{ request('experience_level') === 'senior' ? 'selected' : '' }}>Senior</option>
                    <option value="principal" {{ request('experience_level') === 'principal' ? 'selected' : '' }}>Principal</option>
                </select>
            </div>

            <!-- Apply and Clear buttons -->
            <div class="mb-10">
                <button type="submit" class="w-full lg:w-auto text-white bg-customBlue hover:bg-customDarkBlue focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2">Apply</button>
                @if(request()->has('search') || request()->has('city') || request()->has('experience_level'))
                    <a href="{{ route('developers') }}" class="block text-center w-full lg:w-auto py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200">Clear</a>
                @endif
            </div>
            </form>
        </div>

        <div class="flex flex-col lg:flex-row">

            <!-- Filters column -->
            <div class="w-full lg:w-1/5 mr-4 hidden lg:block">

                <!-- Filters text and line -->
                <div class="flex items-center mb-4">
                    <p class="font-medium text-gray-900">Filters</p>
                    <div class="flex-grow h-px ml-4 bg-gray-300"></div>
                </div>

                <form action="{{ route('developers') }}" method="GET">
                    <!-- Search bar -->
                    <div class="mb-4">
                        <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                        <input type="text" id="search" class="mt-1 px-3 py-2 border border-gray-300 rounded-md w-full" name="search" value="{{ request('search') }}">
                    </div>

                    <!-- Filter by state -->
                    <x-state-select selectedState="{{ request('state') }}" />

                    <!-- Filter by experience level -->
                    <div class="mb-4">
                        <label for="experience" class="block text-sm font-medium text-gray-700">Experience Level</label>
                        <select id="experience" class="mt-1 px-3 py-2 border border-gray-300 rounded-md w-full" name="experience_level">
                            <option value="">All Experience Levels</option>
                            <option value="junior" {{ request('experience_level') === 'junior' ? 'selected' : '' }}>Junior</option>
                            <option value="mid" {{ request('experience_level') === 'mid' ? 'selected' : '' }}>Mid</option>
                            <option value="senior" {{ request('experience_level') === 'senior' ? 'selected' : '' }}>Senior</option>
                            <option value="principal" {{ request('experience_level') === 'principal' ? 'selected' : '' }}>Principal</option>
                        </select>
                    </div>

                    <!-- Apply and Clear buttons -->
                    <div class="space-x-0 lg:space-x-2 mb-10">
                        <button type="submit" class="w-full lg:w-auto text-white bg-customBlue hover:bg-customDarkBlue focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2">Apply</button>
                        @if(request()->has('search') || request()->has('city') || request()->has('experience_level'))
                            <a href="{{ route('developers') }}" class="w-full lg:w-auto py-2.5 px-5 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200">Clear</a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Developers cards column -->
            <div class="w-full lg:w-4/5">
                <!-- Developers text and line -->
                <div class="flex items-center mb-4">
                    @if($developers->total() > 0)
                        <p class="font-medium text-gray-900">{{ $developers->firstItem() }} to {{ $developers->lastItem() }} of {{ $developers->total() }} developers</p>
                    @else
                        <p class="font-medium text-gray-900">{{ $developers->total() }} Developers</p>
                    @endif

                    <div class="flex-grow h-px ml-4 bg-gray-300"></div>
                </div>

                <div class="flex flex-wrap gap-y-4" style="height: fit-content;">
                    @forelse($developers as $developer)
                        <x-developer-card :developer="$developer"></x-developer-card>
                    @empty
                        <div class="w-full text-center text-xl mt-5">
                            <p class="mb-5">No developers found.</p>
                            <img src="{{ url('img/void.svg') }}" class="h-[200px] mx-auto" />
                        </div>

                    @endforelse
                </div>
            </div>
        </div>

        <div class="my-5">
            <nav>
                <ul class="flex items-center justify-end -space-x-px h-10 text-base">
                    <li>
                        <a href="{{ $developers->previousPageUrl() }}" class="flex items-center justify-center px-4 h-10 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            <span class="sr-only">Previous</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                            </svg>
                        </a>
                    </li>

                    @foreach ($developers->links()->elements[0] as $page => $url)
                        <li>
                            <a href="{{ $url }}" class="{{ $page == $developers->currentPage() ? 'bg-blue-50 text-blue-600' : 'text-gray-500' }} flex items-center justify-center px-4 h-10 leading-tight border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">{{ $page }}</a>
                        </li>
                    @endforeach
                    <li>
                        <a href="{{ $developers->nextPageUrl() }}" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            <span class="sr-only">Next</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
@endsection
