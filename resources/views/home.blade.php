@extends('layout.app')

@section('title')
    Página principal
@endsection

@section('content')
    @if ($posts->count())
        <div class="grid grid-cols-1 gap-10 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($posts as $post)
                <div class="w-11/12 mx-auto md:w-full md:mx-0">
                    <a href="{{ route('posts.show', ['user' => $post->user, 'post' => $post]) }}"><img
                            src="{{ asset('uploads') . "/$post->image" }}"></a>
                </div>
            @endforeach
        </div>
    @else
        <h2 class="text-4xl text-center">No hay Publicaciones</h2>
    @endif

@endsection
