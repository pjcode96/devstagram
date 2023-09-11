@extends('layout.app')
@section('title')
    Inicia sesión
@endsection

@section('content')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 md:justify-center md:items-center p-5">
            <img src="{{ asset('img/registrar.jpg') }}" alt="Imagen registro de usuario">
        </div>

        <div class="md:w-5/12 bg-white p-6 rounded-lg shadow-md">
            <form action="{{ route('login') }}" method="POST" class="md:w-11/12 mx-auto">
                @csrf

                @if (session('message'))
                    <div class="mb-2 bg-red-200 p-2">
                        <p class="text-red-600 border-l-4 border-red-700 font-bold pl-2">
                            {{ session('message') }}
                        </p>
                    </div>
                @endif

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>

                    <input id="email" name="email" type="email" placeholder="Tu email" value="{{ old('email') }}"
                        class="border p-3 w-full rounded-lg @error('name') border-red-600 @enderror" novalidate>

                    @error('email')
                        <div class="mt-2 bg-red-200 p-2">
                            <p class="text-red-600 border-l-4 border-red-700 font-bold pl-2">
                                {{ $message }}
                            </p>
                        </div>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Contraseña
                    </label>

                    <input id="password" name="password" type="password" placeholder="Contraseña de registro"
                        class="border p-3 w-full rounded-lg @error('name') border-red-600 @enderror">

                    @error('password')
                        <div class="mt-2 bg-red-200 p-2">
                            <p class="text-red-600 border-l-4 border-red-700 font-bold pl-2">
                                {{ $message }}
                            </p>
                        </div>
                    @enderror
                </div>

                <div class="flex content-center flex-wrap items-center mb-5">
                    <input id="remember" name="remember" type="checkbox" class="w-1/12 h-4">
                    <label for="remember" class="text-md block uppercase text-gray-500 font-bold">
                        Recordar
                    </label>


                </div>

                <input type="submit" value="Crear cuenta"
                    class="bg-sky-600 p-3 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection
