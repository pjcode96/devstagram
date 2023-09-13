@extends('layout.app')
@section('title')
    {{ $post->title }}
@endsection

@section('content')
    <article class="w-full container mx-auto md:flex gap-10">
        <div class="w-6/12">
            <img src="{{ asset('uploads') . "/$post->image" }}" alt="Imagen del post {{ $post->title }}">
            <div class="pt-3">
                <p>0 Likes</p>
            </div>

            <div>
                <p class="font-bold">{{ $post->user->username }}</p>
                <p class="text-sm text-gray-500">
                    {{ $post->created_at->diffForHumans() }}
                </p>
                <p class="mt-5">
                    {{ $post->description }}
                </p>
            </div>
        </div>

        <div class="w-6/12">
            <div class="shadow bg-white p-5 mb-5">
                <p class="text-xl font-bold text-center mb-4">
                    Agrega un nuevo comentario
                </p>

                <form>
                    <div class="mb-5">
                        <label for="comment" class="mb-2 block uppercase text-gray-500 font-bold">
                            Reacción
                        </label>

                        <textarea id="comment" name="comment" placeholder="Me encanta esta foto" rows="6"
                            class="border p-3 w-full rounded-lg @error('comment') border-red-600 @enderror"></textarea>
                        @error('comment')
                            <div class="mt-2 bg-red-200 p-2"></div>
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
    </article>
@endsection
