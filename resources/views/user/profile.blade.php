{{-- тут хранится шаблон соновного html файла --}}
@extends('app')
{{-- секция для указания названия страницы --}}
@section('title')Авторизация@endsection
{{-- секция, куда в основной шаблон html вставляется основной контент данной страницы (секцию нужно закрывать!) --}}

@section('content')
<h1>Страница пользователя {{$user->name}}</h1>

Lorem, ipsum dolor sit amet consectetur adipisicing elit. Animi porro iste placeat aliquam vitae ratione possimus deserunt sint natus iusto ipsum quibusdam quam nostrum culpa quia, dignissimos quis unde quisquam.

@endsection