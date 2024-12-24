{{-- тут хранится шаблон соновного html файла --}}
@extends('app')
{{-- секция для указания названия страницы --}}
@section('title') {{ $user->name }} @endsection
{{-- секция, куда в основной шаблон html вставляется основной контент данной страницы (секцию нужно закрывать!) --}}

@section('content')
  <div class="dropdown">
    <form action="{{ route('user_profile', ['id' => $user->id]) }}">
      <button type="submit" class="badge d-flex align-items-center p-2 pe-2 text-dark-emphasis bg-light-subtle border border-dark-subtle rounded-pill">
        <img class="rounded-circle me-1" width="100" height="100" src="defolt.png" alt="">&nbsp;&nbsp; <h1>{{ $user->name }}</h1>
        {{-- Auth::user() - используется, чтобы считать авторизованного пользователя --}}
      </button>
    </form>
  </div><br>

  <p>Посты пользователя <i>{{ $user->name }}</i></p><br>
  
  {{-- @if(session('success_post'))
  <p>{{ session('success_post') }}</p>
  @endif <br> --}}

  @if($posts->isEmpty())
    <p>У пользователя <i>{{ $user->name }}</i> нет постов.</p> 
  @else
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
    <form action="{{ route('user_posts', ['id' => $user->id]) }}">
      <button class="btn btn-primary w-50 py-2 float-right" type="submit">Все посты {{ $user->name }}</button>
    </form></br>
  @endif
  
@endsection