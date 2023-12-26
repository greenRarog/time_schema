<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>{{ $title }}</title>
        <link href="{{ env('APP_URL') . '/css/style.css'}}" rel="stylesheet" />
        <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->
    </head>
    <body>
        <div class='wrapper'>
        <x-timeschema.header id='{{ $id }}' />
        <main>
            {{ $slot }}
        </main>        
        <x-timeschema.footer />
        </div>
    </body>
</html>
