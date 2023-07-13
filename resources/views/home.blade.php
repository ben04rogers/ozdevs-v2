@extends("layouts.app")

@section("content")
    <div class="bg-white">
        <div class="px-6 pt-14 lg:px-8">
            <div class="mx-auto max-w-3xl lg:py-20">
                <div class="text-center">
                    <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">The reverse job board for developers in Australia</h1>
                    <p class="mt-6 text-lg leading-8 text-gray-600">Find your next developer opportunity in Australia. Create a profile and let companies come to you.</p>
                    <div class="mt-5 flex items-center justify-center gap-x-6">
                        <a href="#" class="bg-gray-900 text-white rounded-md px-4 py-3 text-sm font-medium">Get started</a>
                        <a href="{{ route('developers') }}" class="text-gray-900 border border-gray-900 rounded-md px-4 py-3 text-sm font-medium">Developers</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
