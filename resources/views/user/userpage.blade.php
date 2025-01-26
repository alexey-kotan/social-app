{{-- тут хранится шаблон соновного html файла --}}
@extends('app')
{{-- секция для указания названия страницы --}}
@section('title') {{ $user->name }} @endsection
{{-- секция, куда в основной шаблон html вставляется основной контент данной страницы (секцию нужно закрывать!) --}}

@section('content')

  @include('blocks.user_info')
  
  @if(session('success_post'))
    <span class="badge bg-success-subtle text-success-emphasis rounded-pill mt-4 mb-4">{{ session('success_post') }}</span><br>
  @endif

  <span class="text-gray-700 font-medium text-xl"> Мои посты </span>

  <form action="{{ route('newpost') }}">
    @csrf
    <button class="btn btn-primary w-80 py-2 mb-2 mt-2" type="submit">Новый пост</button>
  </form>

  @if($posts->isEmpty())
    <p>У вас нет постов. Создайте <a href="{{ route('newpost') }}">новый пост</a>.</p> 
  @else
    @include('blocks.posts')
  @endif

  <form action="{{ route('my_posts') }}">
    @csrf
    <button class="btn btn-primary w-50 py-2 float-right mb-8" type="submit">Все мои посты</button>
  </form>

@endsection