{{-- тут хранится шаблон соновного html файла --}}
@extends('app')
{{-- секция для указания названия страницы --}}
@section('title')Авторизация@endsection
{{-- секция, куда в основной шаблон html вставляется основной контент данной страницы (секцию нужно закрывать!) --}}
@section('content')


@if (session('auth_error'))
    <div class="alert alert-danger">{{ session('auth_error') }}</div>
@endif

<div class="w-7/12 mx-auto ">

  <p class="d-flex mt-16 mb-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
    <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
  </svg> Пожалуйста авторизуйтесь</p>

  @error('authError')
    <span class="badge bg-danger-subtle text-success-emphasis rounded-pill mt-4 mb-4 text-wrap">{{ $message }}</span>
  @enderror

  <form action="{{ route('home') }}" method="post" autocomplete="off">
    @csrf

    {{-- вывод сообщения об успешной смене пароля --}}
    @if(session('success'))
      <span class="badge bg-success-subtle text-success-emphasis rounded-pill mt-4 mb-4">{{ session('success') }}</span>
    @endif

    <div class="form-floating">
      <input type="email" class="form-control mb-2" name="email" value="{{ old('email') }}" required autofocus id="email" placeholder="name@example.com">
      <label for="floatingInput">Email</label>
    </div>

    @error('email')
      <span class="badge bg-danger-subtle text-success-emphasis rounded-pill mt-4 mb-4 text-wrap">{{ $message }}</span>
    @enderror

    <div class="form-floating">
      <input type="password" class="form-control" name="password" required autofocus id="password" placeholder="Password">
      <label for="floatingPassword">Пароль</label>
    </div>

    @error('password')
      <span class="badge bg-danger-subtle text-success-emphasis rounded-pill mt-4 mb-4 text-wrap">{{ $message }}</span>
    @enderror

    <div class="flex mt-3 ml-4 mb-2">
      <div class="w-1/2 mx-auto ">
        <input class="form-check-input" type="checkbox" id="remember" name="remember"><label class="form-check-label" for="remember">
          Запомнить меня </label>
      </div>
      <div class="w-1/2 mx-2 text-right" dir="ltr">
        <a href="forgot_pass" class="text-success">Забыли пароль?</a>
      </div>
    </div>
    

    <button class="btn btn-success w-100 py-2 mb-2" type="submit">Авторизоваться</button>
  </form>

  <p>Еще нет аккаунта? Зарегистрируйтесь.</p>

  <form action="{{ route('reg') }}">
    @csrf
    <button class="btn btn-primary w-100 py-2" type="submit">Регистрация</button>
  </form>

</div>

@endsection