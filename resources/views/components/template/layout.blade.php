<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link href="{{ env('APP_URL') . '/css/template-style.css' }}" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="{{ env('APP_URL') . '/js/template-js/cufon-yui.js' }}"></script>
    <script type="text/javascript" src="{{ env('APP_URL') . '/js/template-js/arial.js' }}"></script>
    <script type="text/javascript" src="{{ env('APP_URL') . '/js/template-js/cuf_run.js' }}"></script>
    <script type="text/javascript" src="{{ env('APP_URL') . '/js/template-js/jquery-1.3.2.min.js' }}"></script>
    <script type="text/javascript" src="{{ env('APP_URL') . '/js/template-js/radius.js' }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="{{{ isset($seo_description) ? $seo_description : '' }}}"/>
    <title>{{ $title }}</title>        
</head>
    <body>   
        <div class="main">     
            <x-template.header id='{{{ isset($id) ? $id : 0 }}}' />
            <main>
                {{ $slot }}
            </main>        
            <x-template.footer />
        </div>
    </body>
</html>
