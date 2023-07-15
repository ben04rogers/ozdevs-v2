@extends("layouts.app")

@section("content")
    <div class="bg-white">
        <div class="px-6 pt-14 lg:px-8">
            <div class="mx-auto max-w-3xl lg:py-20">
                <div class="text-center">
                    <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">The reverse job board for developers in Australia</h1>
                    <p class="mt-6 text-lg leading-8 text-gray-600">Find your next developer opportunity in Australia. Create a profile and let companies come to you.</p>
                    <div class="mt-5 flex items-center justify-center gap-x-6">
                        <a href="#" class="bg-gray-900 text-white rounded-md px-3 py-2 sm:px-4 sm:py-3 text-sm font-medium">Get started</a>
                        <a href="{{ route('developers') }}" class="text-gray-900 border border-gray-900 rounded-md px-3 py-2 sm:px-4 sm:py-3 text-sm font-medium">Developers</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto mt-10">
        <div class="flex flex-wrap gap-y-6">
            @foreach ($developers as $developer)
                <div class="bg-white rounded-lg shadow-lg p-6 w-full flex">
                    <div class="mr-4">
                        @empty($developer['avatar'])
                            <div class="w-20 h-20 mb-2 md:mb-0 md:w-36 md:h-36 md:top-6 md:left-0">
                                <svg class="h-auto md:h-auto object-cover rounded-lg border border-gray-300 text-gray-300 bg-gray-100" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>                        @else
                            <img src="{{ $developer['avatar'] }}" alt="Avatar" class="w-12 h-12 rounded-full">
                        @endempty
                    </div>
                    <div class="w-full">
                        <div class="flex justify-between">
                            <h2 class="text-xl font-bold">{{ $developer['hero'] }}</h2>
                            <p>{{ ucfirst($developer['search_status']) }}</p>
                        </div>
                        <p class="text-gray-600 mt-2">{{ $developer['city'] }}, {{ $developer['state'] }}</p>
                        <p class="text-gray-600">{{ $developer['bio'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
