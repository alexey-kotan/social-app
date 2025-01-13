{{-- тут хранится шаблон соновного html файла --}}
@extends('app')
{{-- секция для указания названия страницы --}}
@section('title') {{ $user->name }} @endsection
{{-- секция, куда в основной шаблон html вставляется основной контент данной страницы (секцию нужно закрывать!) --}}

@section('content')
  <div class="mb-3 dropdown flex items-center">
    <img class="rounded-circle me-1" width="100" height="100" src="defolt.png" alt=""> 
    <span class="text-gray-700 font-medium text-2xl">{{ $user->name }}</span>
  </div>

@if(Auth::user()->subscriptions->contains($user->id))
  <form action="{{ route('unsubscribe', ['id' => $user->id]) }}" method="POST">
    @csrf
    <button type="submit" class="mb-3 btn btn-dark">Отписаться</button>
  </form>
@else
  <form action="{{ route('subscribe', ['id' => $user->id]) }}" method="POST">
    @csrf
    <button type="submit" class="mb-3 btn btn-primary">Подписаться</button>
  </form>
@endif

  @if(session('success_subscribe'))
    <p>{{ session('success_subscribe') }}</p>
  @endif <br>

  <span class="text-gray-700 font-medium text-xl">Посты пользователя <i>{{ $user->name }}</i></span><br>
  
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