{{-- тут хранится шаблон соновного html файла --}}
@extends('app')
{{-- секция для указания названия страницы --}}
@section('title') {{ $user->name }} @endsection
{{-- секция, куда в основной шаблон html вставляется основной контент данной страницы (секцию нужно закрывать!) --}}

@section('content')
  <div class="mb-3 dropdown flex items-center">
    <img class="rounded-circle me-1" width="100" height="100" src="{{ asset('storage/' . $user->avatar) }}" alt=""> 
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
    <span class="badge bg-success-subtle text-success-emphasis rounded-pill mt-4 mb-4">{{ session('success_subscribe') }}</span>
  @endif <br>

  <span class="text-gray-700 font-medium text-xl">Посты пользователя <i>{{ $user->name }}</i></span><br>

  @if($posts->isEmpty())
    <p>У пользователя <i>{{ $user->name }}</i> нет постов.</p> 
  @else

    @include('blocks.posts')
    
    <form action="{{ route('user_posts', ['id' => $user->id]) }}">
      @csrf
      <button class="btn btn-primary w-50 py-2 float-right" type="submit">Все посты {{ $user->name }}</button>
    </form></br>
  @endif
  
@endsection