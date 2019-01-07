<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Azrael CMS</title>
        <link rel="icon" href="/images/logo.png">

        <!-- Include Compiled Styles -->
        <link href="/css/app.css" rel="stylesheet">
        
        @yield('head')
    </head>
    <body class="@yield('body-class')">
        <div id="app">
            <admin-panel></admin-panel>
        </div>

        <script>
            /**
             * Pass user data to javascript
             */
            window.user = {
                id: {{ Auth::user()->id }},
                accessToken: "{{ session('accessToken', '') }}"
            };
        </script>

        <script src="/js/app.js"></script>
    </body>
</html>
