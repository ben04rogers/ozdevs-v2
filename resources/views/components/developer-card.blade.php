<div class="bg-white p-6 w-full flex border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
    <div class="mr-4">
        @empty($developer['avatar'])
            <div class="w-20 h-20 mb-2 md:mb-0 md:w-36 md:h-36 md:top-6 md:left-0">
                <svg class="h-auto md:h-auto object-cover rounded-lg border border-gray-300 text-gray-300 bg-gray-100" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
            </div>
        @else
            <img src="{{ $developer['avatar'] }}" alt="Avatar" class="w-12 h-12 rounded-full">
        @endempty
    </div>
    <div class="w-full">
        <div class="flex flex-col sm:flex-row justify-between items-start">
            <h2 class="text-xl font-bold">{{ $developer['hero'] }}</h2>
            <span class="bg-green-100 text-green-800 text-sm font-medium inline-flex md:block mt-2 sm:mt-0 sm:ml-0 md:ml-2 px-2.5 py-1.5 rounded-full dark:bg-green-900 dark:text-green-300">
    {{ ucfirst($developer['search_status']) }}
  </span>
        </div>


        <p class="text-gray-600 mt-2">{{ $developer['city'] }}, {{ $developer['state'] }}</p>
        <p class="text-gray-600">{{ $developer['bio'] }}</p>
    </div>
</div>
