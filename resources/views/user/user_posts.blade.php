{{-- тут хранится шаблон соновного html файла --}}
@extends('app')
{{-- секция для указания названия страницы --}}
@section('title') Посты {{ $user->name }} @endsection
{{-- секция, куда в основной шаблон html вставляется основной контент данной страницы (секцию нужно закрывать!) --}}

@section('content')
    <br>
    <h1>Посты <i>{{ $user->name }}</i></h1><br>

    @include('blocks.posts')
@endsection