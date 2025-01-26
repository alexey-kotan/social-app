{{-- тут хранится шаблон соновного html файла --}}
@extends('app')
{{-- секция для указания названия страницы --}}
@section('title')Смена пароля@endsection
{{-- секция, куда в основной шаблон html вставляется основной контент данной страницы (секцию нужно закрывать!) --}}
@section('content')

  <div class="w-7/12 mx-auto"> 
    <p class="d-flex mt-16 mb-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-unlock" viewBox="0 0 16 16">
      <path d="M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2zM3 8a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1H3z"/>
    </svg>Смена пароля</p>

    <form action="{{ route('password.update') }}" method="post" autocomplete="off">
      {{-- autocomplete - браузер не дает отправить форму, если поля не заполненны --}}
      @csrf
      {{-- <input type="hidden" name="token" value="{{ $request->token }}"> --}}
      <div class="form-floating">
        <input type="email" class="form-control" name="email" value="{{ old('email', $request->email) }}" required readonly id="email">
        {{-- readonly - не позволяет менять поле, но учитыввает данные в поле для отправки --}}
        <label for="floatingInput">Ваш Email</label>
      </div>
      
      <div class="form-floating mt-2 mb-2">
        <input type="password" class="form-control" name="password" required autofocus  id="password" placeholder="Password">
        <label for="floatingPassword">Новый пароль</label>
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

        <button class="btn btn-success w-100 py-2" type="submit">Сменить пароль</button>
    </form>
  </div>
@endsection