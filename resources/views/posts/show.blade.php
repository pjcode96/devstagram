@extends('layout.app')
@section('title')
    {{ $post->title }}
@endsection

@section('content')
    <article class="w-11/12 md:w-full container mx-auto lg:flex gap-10">
        <div class="lg:w-6/12">
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
