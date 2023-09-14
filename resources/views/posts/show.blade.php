@extends('layout.app')
@section('title')
    {{ $post->title }}
@endsection

@section('content')
    <article class="w-11/12 md:w-full container mx-auto lg:flex gap-10">
        <div class="lg:w-6/12">
            <img src="{{ asset('uploads') . "/$post->image" }}" alt="Imagen del post {{ $post->title }}">
            <div class="flex items-center gap-3">
                @auth
                    @if ($post->checkLike(auth()->user()))
                        <form method="POST" action="{{ route('posts.likes.destroy', $post) }}">
                            @csrf
                            @method('DELETE')
                            <div class="my-4">
                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    @else
                        <form method="POST" action="{{ route('posts.likes.store', $post) }}">
                            @csrf
                            <div class="my-4">
                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    @endif

                    </a>
                @endauth
                <p><span class="font-black">{{ $post->likes->count() }}</span> Likes</p>
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

            @auth
                @if (auth()->user()->id === $post->user_id)
                    <form method="POST" action="{{ route('posts.destroy', $post) }}">
                        @method('DELETE')
                        @csrf
                        <input type="submit" value="Eliminar publicación"
                            class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold mt-5 cursor-pointer">
                    </form>
                @endif
            @endauth
        </div>

        <div class="lg:w-6/12">
            <div class="shadow bg-white p-5 mb-5">
                @auth
                    <p class="text-xl font-bold text-center mb-4">
                        Agrega un nuevo comentario
                    </p>

                    @if (session('message'))
                        <div class="bg-emerald-200 rounded-md p-3 mb-3">
                            <p class="p-2 border-emerald-800 border-l-4 font-bold text-emerald-800">
                                {{ session('message') }}
                            </p>
                        </div>
                    @endif

                    <form class="mb-5" action="{{ route('comments.store', ['post' => $post, 'user' => $user]) }}"
                        method="POST">
                        @csrf
                        <div class="mb-5">
                            <label for="comment" class="mb-2 block uppercase text-gray-500 font-bold">
                                Reacción
                            </label>

                            <textarea id="comment" name="comment" placeholder="Me encanta esta foto" rows="6"
                                class="border p-3 w-full rounded-lg @error('comment') border-red-600 @enderror"></textarea>
                            @error('comment')
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
                @endauth

                <h2 class="text-center mt-10 text-3xl">Comentarios</h2>
                <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
                    @if ($post->comments->count())
                        @foreach ($post->comments as $comment)
                            <div class="p-5 border-gray-300 border-b">
                                <a class="font-bold" href="{{ route('posts.index', $comment->user) }}">
                                    {{ $comment->user->username }}
                                </a>
                                <p>{{ $comment->content }}</p>
                                <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="text-center p-10 text-xl">No hay comentarios</p>
                    @endif
                </div>

            </div>
        </div>
    </article>
@endsection
