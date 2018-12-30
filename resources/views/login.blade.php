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
        <form class="login-form card" action="" method="POST">
            @csrf
            <div class="card-content red white-text">
                <span class="card-title">Sign In</span>
            </div>
            <div class="card-content">
                <div class="input-field">
                    <input name="email" id="email" type="text" class="validate">
                    <label for="email">Email</label>
                </div>

                <div class="input-field">
                    <input name="password" id="password" type="password" class="validate">
                    <label for="password">Password</label>
                </div>

                <label>
                    <input type="checkbox" class="checkbox-red filled-in" />
                    <span>Keep me signed in</span>
                </label>

                <div class="row">
                    <button type="submit" class="btn red right">Sign In</button>
                </div>
            </div>
        </form>
    </body>
</html>
