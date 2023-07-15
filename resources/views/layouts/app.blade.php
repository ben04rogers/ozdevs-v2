<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>OzDevs</title>

        @vite(['resources/css/app.css','resources/js/app.js'])

        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    </head>
    <body class="bg-gray-50 dark:bg-gray-900">
        <x-navbar />

        <div class="container max-w-screen-xl mx-auto px-2 sm:px-6 mt-16">
            @yield('content')
        </div>
    </body>
</html>
