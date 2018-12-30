@inject('adminPanel', 'App\AdminPanel')

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Azrael CMS</title>
        <link rel="icon" href="/images/logo.png">

        <!-- Reset Styles - Loads first -->
        <link href="/css/reset.css" rel="stylesheet">

        <!-- Include Material -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>

        <!-- Include Compiled Styles -->
        <link href="/css/app.css" rel="stylesheet">
        
        @yield('head')
    </head>
    <body>
        <div id="navbar" class="navbar-fixed">
            <nav>
                <div class="nav-wrapper">
                    <a href="#" data-target="sidebar" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                </div>
            </nav>
        </div>
        <ul id="sidebar" class="sidenav sidenav-fixed">
            <li>
                <figure class="logo-wrapper"><img class="logo" src="/images/logo.svg" /></figure>
            </li>
            @foreach ($adminPanel->navigation as $item)
                @if ($item instanceof App\Models\NavigationItem)
                    <li class="{{ $item->isActive() ? 'active' : '' }}">
                        <a href="{{ $item->href }}">
                            @if ($item->icon)
                                <i class="material-icons">{{ $item->icon }}</i>
                            @endif
                            <span>{{ $item->label }}</span>
                        </a>
                    </li>
                @elseif ($item instanceof App\Models\NavigationDivider)
                    <li><div class="divider"></div></li>
                @endif
            @endforeach
        </ul>
        <div id="main-wrapper">
            <main>
                <!-- breadcrumbs -->
                @include('snippets.breadcrumbs')

                @yield('content')
            </main>
        </div>

        <script>
            /**
             * Pass access token
             */
            window.user = {
                accessToken: "{{ session('accessToken', '') }}"
            };

            /**
             * Setup Materialize Sidenav
             */
            document.addEventListener('DOMContentLoaded', function() {
                var elems = document.querySelectorAll('.sidenav');
                var instances = M.Sidenav.init(elems);
            });
        </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.slim.min.js"></script>
        <script src="/js/app.js"></script>
    </body>
</html>
