<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @stack('styles')
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    @vite('resources/css/app.css')

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

</head>

<body>
    <header class='p-5 border-b bg-white shadow'>
        <div class="container mx auto flex justify-between items-center">
            <h1 class="text-3xl font-black">Devstagram</h1>
            <nav class="flex gap-2 items-center">

                @auth
                    <a href="{{ route('posts.create') }}"
                        class="flex items-center gap-2 bg-white border p-2 text-gray rounded text-sm uppercase font-bold cursor-pointer hover:border-black transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Crear publicación
                    </a>

                    <a class="font-bold text-gray-600 text-sm" href="{{ route('posts.index', auth()->user()->username) }}">
                        Hola: <span class="font-normal">{{ auth()->user()->username }}</span>
                    </a>
                    <form class="flex items-center m-0" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="font-bold uppercase text-gray-600 text-sm">
                            Cerrar sesión
                        </button>
                    </form>
                @endauth

                @guest
                    <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('login') }}">
                        Login
                    </a>
                    <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('register') }}">
                        Crear cuenta
                    </a>
                @endguest
            </nav>

        </div>
    </header>

    <main class="container mx-auto mt-10">
        <h2 class="font-black text-center text-3xl mb-10">
            @yield('title')
        </h2>
        @yield('content')
    </main>

    <footer class="mt-10 text-center p-5 text-gray-500 uppercase">
        DevStagram - Todos los derecho reservados {{ now()->year }}
    </footer>
</body>

</html>
