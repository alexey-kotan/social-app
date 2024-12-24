{{-- тут хранится шаблон соновного html файла --}}
@extends('app')
{{-- секция для указания названия страницы --}}
@section('title') Посты {{ $user->name }} @endsection
{{-- секция, куда в основной шаблон html вставляется основной контент данной страницы (секцию нужно закрывать!) --}}

@section('content')
    <br>
    <h1>Посты <i>{{ $user->name }}</i></h1><br>

    @foreach($posts as $post)
      <div class="col-md-12">
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-350 position-relativeц">
          <div class="col-auto d-none d-lg-block">
            @if($post->post_image !== null)
                <a href="{{ asset('storage/' . $post->post_image) }}" target="_blank">
                <img src="{{ asset('storage/' . $post->post_image) }}" width="200" height="200" alt="">
                </a>
            @endif
          </div>
          
          <div class="col p-6 d-flex flex-column">
            <div class="mb-1 text-body-secondary">Опубликовал <b>{{ $post->user_name }}</b> в {{ $post->created_at }}</div>
            <p class="mb-auto">{{ $post->post_text }}</p>
          </div>
        </div>
      </div>
    @endforeach
@endsection