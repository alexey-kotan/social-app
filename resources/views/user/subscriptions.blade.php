{{-- тут хранится шаблон соновного html файла --}}
@extends('app')
{{-- секция для указания названия страницы --}}
@section('title') Мои подписки @endsection
{{-- секция, куда в основной шаблон html вставляется основной контент данной страницы (секцию нужно закрывать!) --}}

@section('content')
<div class="dropdown">
    <form action="{{ route('userpage') }}">
      <button type="submit" class="badge d-flex align-items-center p-2 pe-2 text-dark-emphasis bg-light-subtle border border-dark-subtle rounded-pill">
        <img class="rounded-circle me-1" width="100" height="100" src="defolt.png" alt="">&nbsp;&nbsp; <h1>{{ Auth::user()->name }}</h1>
        {{-- Auth::user() - используется, чтобы считать авторизованного пользователя --}}
      </button>
    </form>
  </div><br>

  <h1>Мои подписки</h1><br>

  
  @foreach (Auth::user()->subscriptions as $subscription)  
    <li><a href="/id_{{$subscription->id}}">{{ $subscription->name }}</a></li>
  @endforeach


@endsection