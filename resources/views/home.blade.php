@extends("layouts.app")

@section("content")
    <div class="pt-10 lg:px-8">
        <div class="mx-auto max-w-3xl lg:py-10">
            <div class="text-center">
                <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">The reverse job board for developers in Australia</h1>
                <p class="mt-6 text-lg leading-8 text-gray-600">Find your next developer opportunity in Australia. Create a profile and let companies come to you.</p>
                <div class="mt-5 flex items-center justify-center gap-x-3">
                    <a href="#" class="bg-gray-900 text-white rounded-md px-3 py-2 sm:px-4 sm:py-3 text-sm md:text-lg font-medium">Get started</a>
                    <a href="{{ route('developers') }}" class="text-gray-900 border border-gray-900 rounded-md px-3 py-2 sm:px-4 sm:py-3 text-sm md:text-lg font-medium">Developers</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto mt-10">
        <h2 class="text-xl lg:text-2xl mb-5">Developers available right now</h2>

        <div class="flex flex-wrap gap-y-6">
            @foreach ($developers as $developer)
                <x-developer-card :developer="$developer"></x-developer-card>
            @endforeach
        </div>

        <div class="flex justify-center my-8">
            <a href="{{ route('developers') }}" class="bg-gray-900 text-white rounded-md px-3 py-2 sm:px-4 sm:py-3 text-sm font-medium">See more developers</a>
        </div>
    </div>
@endsection
