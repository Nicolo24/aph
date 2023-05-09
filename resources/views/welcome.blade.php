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

<body class="d-flex h-100 text-center">

    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="mb-auto">
            <div>
                <h3 class="float-md-start mb-0">{{ config('app.name', 'APH - Welcome') }}</h3>
                <nav class="nav nav-masthead justify-content-center float-md-end">

                    @if (Route::has('login'))
                        @auth

                            <a class="nav-link active" aria-current="page" href="{{ url('/dashboard') }}">Panel de control</a>
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
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1>Sistema de Gestión de Atención Prehospitalaria</h1>
                        @auth
                            <a class="btn btn-primary btn-dark " aria-current="page" href="{{ url('/map') }}">Ir al sistema</a>
                        @endauth
                    </div>
                </div>
                <div class="row pt-5">
                    <div class="col-md-6 text-start">
                        <h2>Inventario de Recursos</h2>
                        <p>El ECU911 mantendrá un registro actualizado de los recursos disponibles para su operación. Se ha diseñado una tabla que permite almacenar la información necesaria sobre los recursos de atención prehospitalaria
                            disponibles
                            en diferentes zonas y provincias del país. Este inventario se actualizará regularmente para garantizar un control eficiente sobre la disponibilidad y ubicación de los recursos, lo que permitirá una respuesta
                            rápida ante
                            situaciones de emergencia.</p>
                    </div>
                    <div class="col-md-6 text-start">

                        <h2>Inventario de Bases</h2>
                        <p>El ECU911 mantendrá un registro actualizado de las bases disponibles para su operación. Se ha creado una tabla que permite almacenar la información necesaria sobre las bases de atención prehospitalaria disponibles
                            en
                            diferentes zonas y provincias del país. Este inventario se actualizará regularmente para mantener un control eficiente sobre la disponibilidad y ubicación de las bases, lo que permitirá una respuesta rápida ante
                            situaciones de emergencia.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 text-start">

                        <h2>Registro de Novedades y Asignaciones de Recursos</h2>
                        <p>El ECU911 mantendrá un registro actualizado tanto del estado operativo de los recursos disponibles en cada una de las bases del sistema, como de las asignaciones de recursos a cada base. Para ello, se ha diseñado
                            una
                            tabla que almacena la información de los recursos asignados a cada base, incluyendo su estado (operativo o no operativo) y un comentario sobre la razón de su estado. También se incluirá la fecha y hora de la
                            asignación y
                            desasignación de cada recurso a cada base. Los radio-despachadores del ECU911 serán los encargados de reportar cualquier cambio en el estado operativo de los recursos y en las asignaciones de recursos a través
                            del
                            sistema de reporte disponible.</p>
                    </div>
                    <div class="col-md-6 text-start">
                        <h3>Sistema de Reporte</h3>
                        <p>En el sistema de reporte, se incluirá una lista de todas las bases del sistema, junto con los selectores de recursos disponibles para asignar a cada base y los selectores de estado de cada recurso en cada base.
                            También se
                            incluirá la opción para introducir comentarios sobre el estado de los recursos y las asignaciones a cada base. Cada base tendrá un selector de recursos disponibles para asignar, lo que permitirá al ECU911 tener
                            una
                            visión clara de los recursos asignados y disponibles para responder a emergencias en diferentes zonas y provincias del país.</p>
                        <p>En resumen, el sistema de Gestión de Atención Prehospitalaria permitirá una gestión efectiva de los recursos y una respuesta rápida ante situaciones de emergencia, garantizando así la seguridad de los ciudadanos
                            en todo
                            el país.</p>
                    </div>
                </div>

            </div>
        </main>

        <footer class="mt-auto text-white-50">
            <p></p>
        </footer>
    </div>





</body>

</html>
