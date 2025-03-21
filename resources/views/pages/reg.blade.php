{{-- тут хранится шаблон соновного html файла --}}
@extends('app')
{{-- секция для указания названия страницы --}}
@section('title')Регистрация@endsection
{{-- секция, куда в основной шаблон html вставляется основной контент данной страницы (секцию нужно закрывать!) --}}
@section('content')
<div class="w-7/12 mx-auto ">

  <p class="d-flex mt-16 mb-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-lock" viewBox="0 0 16 16">
    <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 5.996V14H3s-1 0-1-1 1-4 6-4c.564 0 1.077.038 1.544.107a4.524 4.524 0 0 0-.803.918A10.46 10.46 0 0 0 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h5ZM9 13a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v-2Zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1Z"/>
  </svg>Пожалуйста введите свои данные для регистрации</p>

  <form action="{{ route('reg') }}" method="post" autocomplete="off">
    {{-- autocomplete - браузер не дает отправить форму, если поля не заполненны --}}
      @csrf
      <div class="form-floating mb-2">
        <input type="name" class="form-control" name="name" value="{{ old('name') }}" required autofocus  id="name" placeholder="name">
        {{-- old() - массив, хранит в сессии данные, введенные ранее в поле; required autofocus - фокусировка на поле --}}
        <label for="floatingInput">Имя пользователя</label>
        @error('name')
          <span class="badge bg-danger-subtle text-success-emphasis rounded-pill mt-4 mb-4 text-wrap">{{ $message }}</span>
          {{-- вывод ошибки соответствущему полю --}}
        @enderror
      </div>
      <div class="form-floating mb-2">
        <input type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus  id="email" placeholder="name@example.com">
        <label for="floatingInput">Email</label>
        @error('email')
          <span class="badge bg-danger-subtle text-success-emphasis rounded-pill mt-4 mb-4">{{ $message }}</span>
        @enderror
      </div>

      <div class="form-floating mb-2">
        <input type="password" class="form-control" name="password" required autofocus  id="password" placeholder="Password">
        <label for="floatingPassword">Пароль</label>
        @error('password')
          <span class="badge bg-danger-subtle text-success-emphasis rounded-pill mt-4 mb-4">{{ $message }}</span>
        @enderror
      </div>

      <div class="form-floating mb-2">
        <input type="password" class="form-control" name="password_confirmation" required autofocus id="password_confirmation" placeholder="Password">
        <label for="floatingPassword">Повторите пароль</label>
        @error('password_confirmation')
          <span class="badge bg-danger-subtle text-success-emphasis rounded-pill mt-4 mb-4">{{ $message }}</span>
        @enderror
      </div>

      <button class="btn btn-success w-100 py-2 mb-2" type="submit">Зарегистрироваться</button>
  </form>
  <p>Уже есть аккаунта? Авторизуйтесь.</p>
  <form action="{{ route('home') }}">
    @csrf
    <button class="btn btn-primary w-100 py-2" type="submit">Авторизация</button>
  </form>

</div>
@endsection