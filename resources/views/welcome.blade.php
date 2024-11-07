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
        /* Definir la imagen de fondo en el estilo CSS */
        .bg-fondo {
            background-image: url('/images/structure-stadium-baseball-field-arena-court-bernabeu-726222-pxhere.com.jpg');
            background-size: cover;
            /* Ajusta la imagen para cubrir toda la pantalla */
            background-position: center;
            /* Centra la imagen */
            background-repeat: no-repeat;
            /* No repite la imagen */
        }
    </style>

</head>

<body class="bg-fondo font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <!-- Barra de navegación -->
        <nav class="bg-gray-800 p-4 fixed top-0 left-0 right-0 z-10">
            <div class="container mx-auto flex justify-between items-center">
                <!-- Logo o nombre del sitio -->
                <a href="{{ url('/') }}" class="text-white font-bold text-lg">Home</a>

                <!-- Menú de navegación -->
                <div class="flex">
                    <!-- Si el usuario está autenticado -->
                    @auth
                    <p class="text-gray-300 px-3">¡Hola {{auth()->user()->nombre}}!</p>
                    <a href="{{ url('/misturnos') }}" class="text-gray-300 hover:text-white px-3">Mis Turnos</a>
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

        <main class="bg-fondo flex items-center justify-center bg-gray-100 h-screen">
            <!-- Contenedor principal con título y cuadrícula -->
            <div class="w-full max-w-4xl text-center">
                <div class="w-full text-center">
                    <div class="bg-white border border-gray-200 rounded-lg shadow-md mb-4 flex items-center justify-center h-32"> <!-- Añade flex, items-center y justify-center -->
                        <h1 class="text-4xl font-bold mb-6">Seleccioná tu deporte</h1>
                    </div>
                </div>

                <!-- Contenedor en cuadrícula 2x2 -->
                <div class="grid grid-cols-2 gap-5">
                    <!-- Componente 1 -->
                    <a href="{{ route('futbol') }}" class="block bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100 transition transform hover:scale-105">
                        <div class="flex items-center p-4">
                            <div class="w-24 h-24 rounded-full overflow-hidden">
                                <img src="images/futbol.jpg" alt="Imagen" class="w-full h-full object-cover">
                            </div>
                            <div class="ml-4">
                                <h5 class="text-xl font-bold tracking-tight text-gray-900">Fútbol</h5>
                                <p class="text-gray-700">Canchas de 5, 7, 9 y 11</p>
                            </div>
                        </div>
                    </a>

                    <!-- Componente 2 -->
                    <a href="{{ route('basquet') }}" class="block bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100 transition transform hover:scale-105">
                        <div class="flex items-center p-4">
                            <div class="w-24 h-24 rounded-full overflow-hidden">
                                <img src="images/basquet.jpg" alt="Imagen" class="w-full h-full object-cover">
                            </div>
                            <div class="ml-4">
                                <h5 class="text-xl font-bold tracking-tight text-gray-900">Básquet</h5>
                                <p class="text-gray-700">Canchas con piso parquet</p>
                            </div>
                        </div>
                    </a>

                    <!-- Componente 3 -->
                    <a href="{{ route('voley') }}" class="block bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100 transition transform hover:scale-105">
                        <div class="flex items-center p-4">
                            <div class="w-24 h-24 rounded-full overflow-hidden">
                                <img src="images/voley.jpg" alt="Imagen" class="w-full h-full object-cover">
                            </div>
                            <div class="ml-4">
                                <h5 class="text-xl font-bold tracking-tight text-gray-900">Voley</h5>
                                <p class="text-gray-700">Canchas de parquet</p>
                            </div>
                        </div>
                    </a>

                    <!-- Componente 4 -->
                    <a href="{{ route('padel') }}" class="block bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100 transition transform hover:scale-105">
                        <div class="flex items-center p-4">
                            <div class="w-24 h-24 rounded-full overflow-hidden">
                                <img src="images/padel.jpg" alt="Imagen" class="w-full h-full object-cover">
                            </div>
                            <div class="ml-4">
                                <h5 class="text-xl font-bold tracking-tight text-gray-900">Pádel</h5>
                                <p class="text-gray-700">Canchas techadas y al aire libre.</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </main>
    </div>
</body>

</html>