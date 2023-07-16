@extends("layouts.app")

@section("content")
    <div class="container mx-auto mt-10">
        <h2 class="text-xl lg:text-2xl mb-5">Find developers in Australia</h2>

        <div class="flex flex-wrap gap-y-6">
            @foreach ($developers as $developer)
                <x-developer-card :developer="$developer"></x-developer-card>
            @endforeach
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
