{{-- тут хранится шаблон соновного html файла --}}
@extends('app')
{{-- секция для указания названия страницы --}}
@section('title')Регистрация@endsection
{{-- секция, куда в основной шаблон html вставляется основной контент данной страницы (секцию нужно закрывать!) --}}
@section('content')
<h1>Регистрация</h1>

<p>Пожалуйста введите свои данные для регистрации</p>

<form action="{{ route('reg') }}" method="post" autocomplete="off">
  {{-- autocomplete - браузер не дает отправить форму, если поля не заполненны --}}
    @csrf
    <div class="form-floating">
      <input type="name" class="form-control" name="name" value="{{ old('name') }}" required autofocus  id="name" placeholder="name">
      {{-- old() - массив, хранит в сессии данные, введенные ранее в поле; required autofocus - фокусировка на поле --}}
      <label for="floatingInput">Имя пользователя</label>
      @error('name')
        <p>{{ $message }}</p>
        {{-- вывод ошибки соответствущему полю --}}
      @enderror
    </div>
    <div class="form-floating">
      <input type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus  id="email" placeholder="name@example.com">
      <label for="floatingInput">Email</label>
      @error('email')
        <p>{{ $message }}</p>
      @enderror
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" name="password" required autofocus  id="password" placeholder="Password">
      <label for="floatingPassword">Пароль</label>
      @error('password')
        <p>{{ $message }}</p>
      @enderror
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" name="password_confirmation" required autofocus id="password_confirmation" placeholder="Password">
      <label for="floatingPassword">Повторите пароль</label>
      @error('password_confirmation')
        <p class="text-danger">{{ $message }}</p>
      @enderror
      </br>
    </div>
    <button class="btn btn-success w-100 py-2" type="submit">Зарегистрироваться</button>
  </form></br>
  <p>Уже есть аккаунта? Авторизуйтесь.</p>
  <form action="{{ route('home') }}">
    <button class="btn btn-primary w-100 py-2" type="submit">Авторизация</button>
  </form>
@endsection