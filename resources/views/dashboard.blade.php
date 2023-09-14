@extends('layout.app')

@section('title')
    Muro de {{ $user->username }}
@endsection

@section('content')
    <div class="flex justify-center">
        <div class="flex flex-col items-center md:flex-row w-full md:w-8/12 lg:w-6/12">
            <div class="self-center w-8/12 lg:w-6/12 px-5">
                <img src="{{ asset('img/usuario.svg') }}" alt="Imagen de usuario">
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center py-10">
                <p class="text-gray-700 text-2xl">{{ $user->username }}</p>

                <p class="text-gray-800 text-sm mt-5 mb-3 font-bold">
                    0
                    <span class="font-normal">Seguidores</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    0
                    <span class="font-normal">Siguiendo</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    0
                    <span class="font-normal">Post</span>
                </p>
            </div>
        </div>
    </div>

    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">
            Publicaciones
        </h2>

        @if ($posts->count())
            <div class="flex flex-col items-center gap-10">
                <div class="md:grid md:grid-cols-2 xl:grid-cols-3 gap-10">
                    @foreach ($posts as $post)
                        <div>
                            <a href="{{ route('posts.show', ['post' => $post, 'user' => $user]) }}">
                                <img src="{{ asset("uploads/$post->image") }}" alt="Imagen del post {{ $post->title }}">
                            </a>
                        </div>
                    @endforeach
                </div>

                <div>
                    {{ $posts->links('pagination::tailwind') }}
                </div>
            </div>
        @else
            <p class="text-gray-600 uppercase text-sm text-center text-bold">No hay posts disponibles</p>
        @endif
    </section>
@endsection
