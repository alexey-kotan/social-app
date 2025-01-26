{{-- тут хранится шаблон соновного html файла --}}
@extends('app')
{{-- секция для указания названия страницы --}}
@section('title') {{ $user->name }} @endsection
{{-- секция, куда в основной шаблон html вставляется основной контент данной страницы (секцию нужно закрывать!) --}}

@section('content')

  @include('blocks.user_info')
    
  @include('blocks.subscribe_block')

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
      <button class="btn btn-primary w-50 py-2 float-right mb-2" type="submit">Все посты {{ $user->name }}</button>
    </form></br>
  @endif
  
@endsection