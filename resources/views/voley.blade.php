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

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <!-- Barra de navegación -->
        <nav class="bg-gray-800 p-4">
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

        <main class="bg-fondo flex items-center justify-center bg-gray-100 h-screen">

            <div class="w-full text-center">
                <div class="bg-white border border-gray-200 rounded-lg shadow-md mb-4 flex items-center justify-center h-32"> <!-- Añade flex, items-center y justify-center -->
                    <h1 class="text-4xl font-bold mb-6">Canchas de voley</h1>
                </div>
            </div>

        </main>
    </div>
</body>

</html>