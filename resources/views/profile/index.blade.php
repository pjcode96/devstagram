@extends('layout.app')

@section('title')
    Editar Perfil: {{ auth()->user()->username }}
@endsection

@section('content')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form method="POST" action="{{ route('profile.store') }}" enctype="multipart/form-data" class="mt-10 md:mt-0">
                @csrf
                @if (session('message'))
                    <div class="mb-2 bg-red-200 p-2">
                        <p class="text-red-600 border-l-4 border-red-700 font-bold pl-2">
                            {{ session('message') }}
                        </p>
                    </div>
                @endif
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nombre usuario
                    </label>

                    <input id="username" name="username" type="text" placeholder="Tu nombre de usuario"
                        value="{{ auth()->user()->username }}"
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
                    <label for="image" class="mb-2 block uppercase text-gray-500 font-bold">
                        Imagen perfil
                    </label>

                    <input id="image" name="image" type="file" accept=".jpg, .jpeg, .png" value=""
                        class="border p-3 w-full rounded-lg @error('image') border-red-600 @enderror" novalidate>

                    @error('image')
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

                    <input id="email" name="email" type="email" placeholder="Contraseña"
                        value="{{ auth()->user()->email }}"
                        class="border p-3 w-full rounded-lg @error('name') border-red-600 @enderror">

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

                    <input id="password" name="password" type="password" placeholder="Contraseña"
                        class="border p-3 w-full rounded-lg @error('name') border-red-600 @enderror">

                    @error('password')
                        <div class="mt-2 bg-red-200 p-2">
                            <p class="text-red-600 border-l-4 border-red-700 font-bold pl-2">
                                {{ $message }}
                            </p>
                        </div>
                    @enderror
                </div>

                <input type="submit" value="Guardar cambios"
                    class="bg-sky-600 p-3 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full text-white rounded-lg">

            </form>
        </div>
    </div>
@endsection
