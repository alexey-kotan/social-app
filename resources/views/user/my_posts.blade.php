{{-- тут хранится шаблон соновного html файла --}}
@extends('app')
{{-- секция для указания названия страницы --}}
@section('title') Мои посты @endsection
{{-- секция, куда в основной шаблон html вставляется основной контент данной страницы (секцию нужно закрывать!) --}}

@section('content')
    <br>
    <h1>Мои посты</h1><br>

    @if(session('success_post'))
        <span class="badge bg-success-subtle text-success-emphasis rounded-pill mt-4 mb-4">{{ session('success_post') }}</span>
    @endif <br>

    <form action="{{ route('newpost') }}">
        @csrf
        <button class="btn btn-primary w-50 py-2" type="submit">Новый пост</button>
    </form><br>

    @if($posts->isEmpty())
        <p>У вас нет постов. Создайте <a href="{{ route('newpost') }}">новый пост</a>.</p> 
    @else
      @include('blocks.posts')
    @endif
    
@endsection