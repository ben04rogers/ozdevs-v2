@extends("layouts.app")

@section("content")
    <div class="container mx-auto mt-10">
        <h2 class="text-xl lg:text-2xl mb-5">Find developers in Australia</h2>

        <p class="text-gray-500 mb-4">Showing {{ $developers->firstItem() }} to {{ $developers->lastItem() }} of {{ $developers->total() }} developers</p>


        <div class="flex flex-col lg:flex-row">
            <!-- Filters column -->
            <div class="w-full lg:w-1/5 mr-4">
                <form action="{{ route('developers') }}" method="GET">

                    <!-- Search bar -->
                    <div class="mb-4">
                        <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                        <input type="text" id="search" class="mt-1 px-3 py-2 border border-gray-300 rounded-md w-full" name="search" value="{{ request('search') }}">
                    </div>

                    <!-- Filter by city -->
                    <div class="mb-4">
                        <label for="city" class="block text-sm font-medium text-gray-700">State</label>
                        <select id="city" class="mt-1 px-3 py-2 border border-gray-300 rounded-md w-full" name="state">
                            <option value="">All States</option>
                            <option value="nsw" {{ request('state') === 'nsw' ? 'selected' : '' }}>New South Wales</option>
                            <option value="vic" {{ request('state') === 'vic' ? 'selected' : '' }}>Victoria</option>
                            <option value="qld" {{ request('state') === 'qld' ? 'selected' : '' }}>Queensland</option>
                            <option value="wa" {{ request('state') === 'wa' ? 'selected' : '' }}>Western Australia</option>
                            <option value="sa" {{ request('state') === 'sa' ? 'selected' : '' }}>South Australia</option>
                            <option value="tas" {{ request('state') === 'tas' ? 'selected' : '' }}>Tasmania</option>
                            <option value="act" {{ request('state') === 'act' ? 'selected' : '' }}>Australian Capital Territory</option>
                            <option value="nt" {{ request('state') === 'nt' ? 'selected' : '' }}>Northern Territory</option>
                        </select>
                    </div>

                    <!-- Filter by experience level -->
                    <div class="mb-4">
                        <label for="experience" class="block text-sm font-medium text-gray-700">Experience Level</label>
                        <select id="experience" class="mt-1 px-3 py-2 border border-gray-300 rounded-md w-full" name="experience_level">
                            <option value="">All Experience Levels</option>
                            <option value="junior" {{ request('experience_level') === 'junior' ? 'selected' : '' }}>Junior</option>
                            <option value="intermediate" {{ request('experience_level') === 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                            <option value="senior" {{ request('experience_level') === 'senior' ? 'selected' : '' }}>Senior</option>
                            <!-- Add more experience level options here -->
                        </select>
                    </div>

                    <!-- Add more filters here -->

                    <!-- Apply and Clear buttons -->
                    <div class="space-x-0 lg:space-x-2 mb-10">
                        <button type="submit" class="w-full lg:w-auto text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2">Apply</button>
                        @if(request()->has('search') || request()->has('city') || request()->has('experience_level'))
                            <a href="{{ route('developers') }}" class="w-full lg:w-auto py-2.5 px-5 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200">Clear</a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Developers cards column -->
            <div class="flex flex-wrap w-full lg:w-4/5 gap-y-6" style="height: fit-content;">
                @forelse($developers as $developer)
                    <x-developer-card :developer="$developer"></x-developer-card>
                @empty
                    <p>No developers found.</p>
                @endforelse
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
