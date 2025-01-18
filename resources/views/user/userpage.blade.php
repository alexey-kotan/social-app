{{-- тут хранится шаблон соновного html файла --}}
@extends('app')
{{-- секция для указания названия страницы --}}
@section('title') {{ Auth::user()->name }} @endsection
{{-- секция, куда в основной шаблон html вставляется основной контент данной страницы (секцию нужно закрывать!) --}}

@section('content')
  <div class="dropdown flex items-center">
    <img class="rounded-circle me-1" width="100" height="100" src="{{ asset('storage/' . Auth::user()->avatar) }}" alt=""> 
    <span class="text-gray-700 font-medium text-2xl">{{ Auth::user()->name }} </span>
  </div><br>
  
  <form action="{{ route('edit_profile') }}">
    @csrf
    <button class="btn btn-light w-40 py-1 mb-2" type="submit">Сменить аватар</button>
  </form>

  <span class="text-gray-700 font-medium text-xl"> Мои посты </span>

  <form action="{{ route('newpost') }}">
    @csrf
    <button class="btn btn-primary w-80 py-2" type="submit">Новый пост</button>
  </form>

  @if(session('success_post'))
    <span class="badge bg-success-subtle text-success-emphasis rounded-pill mt-4 mb-4">{{ session('success_post') }}</span>
  @endif

  @if($posts->isEmpty())
    <p>У вас нет постов. Создайте <a href="{{ route('newpost') }}">новый пост</a>.</p> 
  @else
    @include('blocks.posts')
  @endif

  <form action="{{ route('my_posts') }}">
    @csrf
    <button class="btn btn-primary w-50 py-2 float-right" type="submit">Все мои посты</button>
  </form>
</br>

@endsection