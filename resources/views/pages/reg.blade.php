{{-- тут хранится шаблон соновного html файла --}}
@extends('app')
{{-- секция для указания названия страницы --}}
@section('title')Регистрация@endsection
{{-- секция, куда в основной шаблон html вставляется основной контент данной страницы (секцию нужно закрывать!) --}}
@section('content')
<h1>Регистрация</h1>

<p>Пожалуйста введите свои данные для регистрации</p>

{{-- <ul>
    @foreach ($errors->all() as $massage)
      <li>
        <div class="text-bg-warning p-3">
          {{ $massage }}
        </div>
      </li>
    @endforeach
</ul> --}}

<form action="{{ route('reg') }}" method="post">
    @csrf
    <div class="form-floating">
      <input type="name" class="form-control" name="name" id="name" placeholder="name">
      <label for="floatingInput">Имя пользователя</label>
    </div>
    <div class="form-floating">
      <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com">
      <label for="floatingInput">Email</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" name="password" id="password" placeholder="Password">
      <label for="floatingPassword">Пароль</label></br>
    </div>
    <button class="btn btn-success w-100 py-2" type="submit">Зарегистрироваться</button>
  </form></br>
  <p>Уже есть аккаунта? Авторизуйтесь.</p>
  <form action="{{ route('auth') }}">
    <button class="btn btn-primary w-100 py-2" type="submit">Авторизация</button>
  </form>
@endsection