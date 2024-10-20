<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .bg-fondo {
            background-image: url('/images/structure-stadium-baseball-field-arena-court-bernabeu-726222-pxhere.com.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
    @livewireStyles

</head>

<body class="font-sans antialiased bg-fondo">
    <div class="min-h-screen flex flex-col">
        <!-- Barra de navegación -->
        <nav class="bg-gray-800 p-4 h-16">
            <div class="container mx-auto flex justify-between items-center">
                <!-- Logo o nombre del sitio -->
                <a href="{{ url('/') }}" class="text-white font-bold text-lg">Home</a>

                <!-- Menú de navegación -->
                <div>
                    <!-- Si el usuario está autenticado -->
                    @auth
                    <a href="{{ url('/dashboard') }}" class="text-gray-300 hover:text-white px-3">Dashboard</a>
                    @else
                    <!-- Si el usuario no está autenticado -->
                    <a href="{{ route('login') }}" class="text-gray-300 hover:text-white px-3">Iniciar Sesión</a>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="text-gray-300 hover:text-white px-3">Registrarse</a>
                    @endif
                    @endauth
                </div>
            </div>
        </nav>
        <!-- Page Content -->

        <main class="flex flex-1 items-center justify-center">

            <div class="w-full max-w-4xl text-center">
                <div class="w-full text-center">
                    <div class="bg-white border border-gray-200 rounded-lg shadow-md mb-4 flex items-center justify-center h-32">
                        <h1 class="text-4xl font-bold mb-6">Seleccioná los detalles del turno</h1>
                    </div>
                </div>
                @livewire('seleccion-cancha-futbol', ['canchas_disponibles' => $canchas_disponibles])
                <div class="flex mt-4">
                    <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 text-sm font-medium bg-white border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Volver
                    </a>
                </div>


            </div>



        </main>
    </div>
    @livewireScripts
</body>

</html>