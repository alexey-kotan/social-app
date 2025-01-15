{{-- тут хранится шаблон соновного html файла --}}
@extends('app')
{{-- секция для указания названия страницы --}}
@section('title') Все посты @endsection
{{-- секция, куда в основной шаблон html вставляется основной контент данной страницы (секцию нужно закрывать!) --}}

@section('content')
    <br>
    <h1>Все посты</h1><br>

    <form action="{{ route('newpost') }}">
        @csrf
        <button class="btn btn-primary w-50 py-2" type="submit">Новый пост</button>
    </form><br>

    @if($posts->isEmpty())
        <p>Сейчас нет ни одного поста. Будьте первым, создайте <a href="{{ route('newpost') }}">первый пост</a>.</p> 
    @else
      @include('blocks.posts')
    @endif
    
@endsection