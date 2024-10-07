{{-- тут хранится шаблон соновного html файла --}}
@extends('app')
{{-- секция для указания названия страницы --}}
@section('title')Авторизация@endsection
{{-- секция, куда в основной шаблон html вставляется основной контент данной страницы (секцию нужно закрывать!) --}}
@section('content')
<h1>Авторизация</h1>

@foreach ($errors->all() as $message) 
{{-- $errors - хранит все ошибки, возникшие во время обработки запроса при валидации форм
all() - возвращает все сообщения об ошибках в виде массива и закладывает в переменную $message --}}
  <ul>
    <li>
      <div class='p-3 rounded-2 bg-danger'>
        {{ $message }}
      </div>
    </li>
  </ul>
@endforeach

<p>Пожалуйста авторизуйтесь</p>
<form action="{{ route('auth') }}" method="post">
  @csrf
  <div class="form-floating">
    <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com">
    <label for="floatingInput">Email</label>
  </div>
  <div class="form-floating">
    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
    <label for="floatingPassword">Пароль</label></br>
  </div>
    <button class="btn btn-success w-100 py-2" type="submit">Авторизоваться</button>
  </form></br>
  <p>Еще нет аккаунта? Зарегистрируйтесь.</p>
  <form action="{{ route('reg') }}">
    <button class="btn btn-primary w-100 py-2" type="submit">Регистрация</button>
  </form>
@endsection