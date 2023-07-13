<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>OzDevs</title>

        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

        @vite('resources/css/app.css')

    </head>
    <body>
        <x-navbar />

        <div class="container mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            @yield('content')
        </div>
    </body>
</html>
