@extends("layouts.app")

@section("content")
    <section class="dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">Reverse Job Board for Developers in Australia</h1>
                <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">Find your next developer opportunity in Australia. Create a profile and let companies come to you.</p>
                <a href="{{ route('getStarted') }}" class="text-white bg-customBlue hover:bg-customDarkBlue focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg px-5 py-3 mr-2 mb-2">Get Started</a>
                <a href="{{ route('developers') }}" class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-4 focus:ring-gray-100">
                    Developers
                </a>
            </div>
            <div class="hidden lg:mt-0 lg:col-span-5 lg:flex justify-end">
                <img src="{{ url('img/people.svg') }}" class="h-[350px]">
            </div>
        </div>
    </section>

    <div class="container mx-auto mt-10">
        <h2 class="text-xl lg:text-2xl mb-5">Developers available right now</h2>

        <div class="flex flex-wrap gap-y-4">
            @foreach ($developers as $developer)
                <x-developer-card :developer="$developer"></x-developer-card>
            @endforeach
        </div>

        <div class="flex justify-center my-8">
            <a href="{{ route('developers') }}" class="bg-customBlue hover:bg-customDarkBlue text-white rounded-md px-3 py-2 sm:px-4 sm:py-3 text-sm font-medium">See more developers</a>
        </div>
    </div>
@endsection
