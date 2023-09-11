@extends('layout.app')
@section('title')
    Regístrate
@endsection

@section('content')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 md:justify-center md:items-center p-5">
            <img src="{{ asset('img/registrar.jpg') }}" alt="Imagen registro de usuario">
        </div>

        <div class="md:w-5/12 bg-white p-6 rounded-lg shadow-md">
            <form action="/register" method="POST" class="md:w-11/12 mx-auto">
                @csrf
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nombre
                    </label>

                    <input id="name" name="name" type="text" placeholder="Tu nombre" value="{{ old('name') }}"
                        class="border p-3 w-full rounded-lg @error('name') border-red-600 @enderror">
                    @error('name')
                        <div class="mt-2 bg-red-200 p-2">
                            <p class="text-red-600 border-l-4 border-red-700 font-bold pl-2">
                                {{ $message }}
                            </p>
                        </div>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nombre usuario
                    </label>

                    <input id="username" name="username" type="text" placeholder="Tu nombre de usuario"
                        value="{{ old('username') }}"
                        class="border p-3 w-full rounded-lg @error('name') border-red-600 @enderror">

                    @error('username')
                        <div class="mt-2 bg-red-200 p-2">
                            <p class="text-red-600 border-l-4 border-red-700 font-bold pl-2">
                                {{ $message }}
                            </p>
                        </div>
                    @enderror
                </div>

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
                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                        Repetir contraseña
                    </label>

                    <input id="password_confirmation" name="password_confirmation" type="password"
                        placeholder="Contraseña de registro"
                        class="border p-3 w-full rounded-lg @error('name') border-red-600 @enderror">
                    @error('password_confirmation')
                        <div class="mt-2 bg-red-200 p-2">
                            <p class="text-red-600 border-l-4 border-red-700 font-bold pl-2">
                                {{ $message }}
                            </p>
                        </div>
                    @enderror
                </div>

                <input type="submit" value="Crear cuenta"
                    class="bg-sky-600 p-3 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection
