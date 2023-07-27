<a href="{{ url('/developer-profiles/' . $developer->id) }}" class="bg-white p-6 w-full flex border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
    <div class="mr-4">
        @empty($developer['avatar'])
{{--            <div class="w-20 h-20 mb-2 md:mb-0 md:w-36 md:h-36 md:top-6 md:left-0">--}}
{{--                <svg class="h-auto md:h-auto object-cover rounded-lg border border-gray-300 text-gray-300 bg-gray-100" fill="currentColor" viewBox="0 0 24 24">--}}
{{--                    <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z"></path>--}}
{{--                </svg>--}}
{{--            </div>--}}
            <img src="https://randomuser.me/api/portraits/men/{{ $developer['id'] }}.jpg" alt="Avatar" class="h-auto md:h-auto object-cover rounded-lg border border-gray-300">
        @else
            <img src="{{ $developer['avatar'] }}" alt="Avatar" class="h-auto md:h-auto object-cover rounded-lg border border-gray-300">
        @endempty
    </div>
    <div class="w-full">
        <div class="flex flex-col sm:flex-row justify-between items-start">
            <h2 class="text-xl font-bold">{{ $developer['hero'] }}</h2>
             <div class="flex items-center">
                  <span class="inline-flex items-center justify-center flex-shrink-0 w-4 h-4 mr-1 text-white bg-customBlue rounded-full">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                            <path d="M20 6L9 17l-5-5"></path>
                        </svg>
                </span>
                 <p style="width: max-content;">{{ ucfirst($developer['search_status']) }}</p>
             </div>
        </div>
        <p class="text-gray-600 mt-1">{{ $developer['city'] }}, {{ strtoupper($developer['state']) }}</p>
        <p class="text-gray-600 mt-1" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
            {{ $developer['bio'] }}
        </p>
        <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300 mt-3">{{ ucfirst($developer['role_level']) }}</span>
    </div>
</a>
