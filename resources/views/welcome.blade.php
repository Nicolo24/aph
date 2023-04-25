<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'APH - Welcome') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <script src="https://kit.fontawesome.com/fd2744f621.js" crossorigin="anonymous"></script>


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="cover.css" rel="stylesheet">
</head>

<body class="d-flex h-100 text-center text-white bg-dark">

    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="mb-auto">
            <div>
                <h3 class="float-md-start mb-0">ECU911 APH</h3>
                @if (Route::has('login'))
                    <nav class="nav nav-masthead justify-content-center float-md-end">
                        @auth

                            <a class="nav-link active" aria-current="page" href="{{ url('/home') }}">Home</a>
                        @else
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                            @if (Route::has('register'))
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            @endif
                        @endauth
                @endif



                </nav>
            </div>
        </header>

        <main class="px-3">
            <h1>Sistema de administración de recursos y bases.</h1>
            <p class="lead"></p>
            <p class="lead">
                @auth
                    <a class="btn btn-primary" aria-current="page" href="{{ url('/home') }}">Ir al sistema</a>
                @endauth
            </p>
        </main>

        <footer class="mt-auto text-white-50">
            <p></p>
        </footer>
    </div>





</body>

</html>
