@extends('layout.app')

@section('title')
    Crea una nueva publicación
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    @vite('resources/js/app.js')
@endpush
@section('content')
    <div class="md:flex md:items-center">
        <div class="md:w-6/12 px-10">
            <form id="dropzone" action="{{ route('image.store') }}" method="POST" enctype="multipart/form-data"
                class="dropzone border-dashed border-2 w-full h-96 rounded-md flex flex-col justify-center items-center">
                @csrf
            </form>
        </div>
        <div class="md:w-6/12 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-0">
            <form action="{{ route('posts.store') }}" method="POST">
                @csrf
                <div class="mb-5">
                    <label for="title" class="mb-2 block uppercase text-gray-500 font-bold">
                        Título
                    </label>

                    <input id="title" name="title" type="text" placeholder="Título de publicación"
                        value="{{ old('title') }}"
                        class="border p-3 w-full rounded-lg @error('title') border-red-600 @enderror">
                    @error('title')
                        <div class="mt-2 bg-red-200 p-2">
                            <p class="text-red-600 border-l-4 border-red-700 font-bold pl-2">
                                {{ $message }}
                            </p>
                        </div>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="description" class="mb-2 block uppercase text-gray-500 font-bold">
                        Descripción
                    </label>

                    <textarea id="description" name="description" placeholder="En la foto se muestra..." rows="6"
                        class="border p-3 w-full rounded-lg @error('description') border-red-600 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="mt-2 bg-red-200 p-2">
                            <p class="text-red-600 border-l-4 border-red-700 font-bold pl-2">
                                {{ $message }}
                            </p>
                        </div>
                    @enderror
                </div>

                <div class="mb-5">
                    <input name="image" type="hidden" value="{{ old('image') }}">
                    @error('image')
                        <div class="mt-2 bg-red-200 p-2">
                            <p class="text-red-600 border-l-4 border-red-700 font-bold pl-2">
                                {{ $message }}
                            </p>
                        </div>
                    @enderror
                </div>

                <input type="submit" value="Crear publicación"
                    class="bg-sky-600 p-3 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection
