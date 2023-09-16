@extends('layout.app')

@section('title')
    Muro de {{ $user->username }}
@endsection

@section('content')
    <div class="flex justify-center">
        <div class="flex flex-col items-center md:flex-row w-full md:w-8/12 lg:w-6/12">
            <div class="self-center w-8/12 lg:w-6/12 px-5">
                <img class="rounded-full"
                    src="{{ $user->image ? asset('profiles/' . $user->image) : asset('img/usuario.svg') }}"
                    alt="Imagen de usuario">
            </div>


            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center py-10">
                <div class="flex gap-5 items-center">
                    <p class="text-gray-700 text-2xl">{{ $user->username }}</p>
                    @auth
                        @if ($user->id === auth()->user()->id)
                            <a href="{{ route('profile.index') }}" class="text-gray-500 hover:text-gray-600 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                </svg>
                            </a>
                        @endif
                    @endauth
                </div>

                <p class="text-gray-800 text-sm mt-5 mb-3 font-bold">
                    {{ $user->followers->count() }}
                    <span class="font-normal">@choice('Seguidor|Seguidores', $user->followers->count())</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{ $user->following->count() }}
                    <span class="font-normal">Siguiendo</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{ $user->posts->count() }}
                    <span class="font-normal">Post</span>
                </p>

                @auth
                    @if ($user->followedByCurrentUser())
                        <form action="{{ route('users.unfollow', $user) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            @if (auth()->user()->id !== $user->id)
                                <input
                                    class="bg-red-600 text-center text-white uppercase rounded-lg px-5 py-3 text-xs font-bold cursor-pointer hover:bg-indigo-600 transition-colors"
                                    value="dejar de seguir" type="submit">
                            @endif
                        </form>
                    @else
                        <form action="{{ route('users.follow', $user) }}" method="POST">
                            @csrf
                            @if (auth()->user()->id !== $user->id)
                                <input
                                    class="bg-blue-600 text-center text-white uppercase rounded-lg px-5 py-3 text-xs font-bold cursor-pointer hover:bg-indigo-600 transition-colors"
                                    value="seguir" type="submit">
                            @endif
                        </form>
                    @endif
                @endauth
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
