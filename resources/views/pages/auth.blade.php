{{-- тут хранится шаблон соновного html файла --}}
@extends('app')
{{-- секция для указания названия страницы --}}
@section('title')Авторизация@endsection
{{-- секция, куда в основной шаблон html вставляется основной контент данной страницы (секцию нужно закрывать!) --}}
@section('content')

<div class="w-5/12 mx-auto ">
<h1>Авторизация</h1>

<p>Пожалуйста авторизуйтесь</p>
<form action="{{ route('home') }}" method="post" autocomplete="off">
  @csrf

  {{-- вывод сообщения об успешной смене пароля --}}
  @if(session('success'))
    <span class="badge bg-success-subtle text-success-emphasis rounded-pill mt-4 mb-4">{{ $message }}</span>
  @endif

  <div class="form-floating">
    <input type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus id="email" placeholder="name@example.com">
    <label for="floatingInput">Email</label>
    @error('email')
      <p>{{ $message }}</p>
    @enderror
  </div>

  <div class="form-floating">
    <input type="password" class="form-control" name="password" required autofocus id="password" placeholder="Password">
    <label for="floatingPassword">Пароль</label>

    <div class="form-check text-start my-3">
      <input class="form-check-input" type="checkbox" id="remember" name="remember"><label style="margin-right: 460px;" class="form-check-label" for="remember">
        Запомнить меня </label>
      
      <a href="forgot_pass" class="text-success">Забыли пароль?</a>
    </div>
  </div>

    <button class="btn btn-success w-100 py-2" type="submit">Авторизоваться</button>
  </form></br>

  <p>Еще нет аккаунта? Зарегистрируйтесь.</p>

  <form action="{{ route('reg') }}">
    @csrf
    <button class="btn btn-primary w-100 py-2" type="submit">Регистрация</button>
  </form>

</div>

@endsection