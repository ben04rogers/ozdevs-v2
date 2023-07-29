<a href="{{ url('/developer-profiles/' . $developer->id) }}" class="bg-white p-6 w-full flex border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
    <div class="mr-4">
        @empty($developer['image'])
            <img src="{{ asset('/img/profile-placeholder.png') }}" alt="profile" class="h-auto md:h-auto object-cover max-w-36 max-h-36 rounded-lg border border-gray-300">
{{--            <img src="https://randomuser.me/api/portraits/men/{{ $developer['id'] }}.jpg" alt="Avatar" class="h-auto md:h-auto object-cover max-w-36 max-h-36 rounded-lg border border-gray-300">--}}
        @else
            <img src="{{ $developer['image'] }}" alt="Avatar" class="h-auto md:h-auto object-cover max-w-36 max-h-36 rounded-lg border border-gray-300">
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
        <p class="text-gray-600 mt-1">{{ $developer['city'] }}, {{ ucfirst($developer['state']) }}</p>
        <p class="text-gray-600 mt-1" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
            {{ $developer['bio'] }}
        </p>
        <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300 mt-3">{{ ucfirst($developer['role_level']) }}</span>
    </div>
</a>
