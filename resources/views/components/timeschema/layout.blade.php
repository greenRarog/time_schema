<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>{{ $title }}</title>

        <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->
    </head>
    <body>
        <x-timeschema.header />
        <main>
            {{ $slot }}
        </main>        
        <x-timeschema.footer />
    </body>
</html>
