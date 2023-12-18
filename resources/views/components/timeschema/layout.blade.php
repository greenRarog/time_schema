<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>{{ $title }}</title>
        <style>
            nav {
                display: flex;
                flex-direction: row;
                justify-content: space-around;
                height: 100%;
            }
            nav div {
                border:1px solid black;
                background-color: lightblue;
                border-radius: 10%;
                padding-top: 10px;
                padding-bottom: 10px;
                padding-left: 20px;
                padding-right: 20px;
            }
            a:active, /* активная/посещенная ссылка */
            a:hover,  /* при наведении */
            a {
                text-decoration: none;
                color: #666;
            }
            body {
                color: #666;
            }
            header {
                background-color:ghostwhite;
            }
            footer {
                background-color:ghostwhite;
                height: 100%;
            }
        </style>
        <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->
    </head>
    <body>
        <x-timeschema.header id='{{ $id }}' />
        <main>
            {{ $slot }}
        </main>        
        <x-timeschema.footer />
    </body>
</html>
