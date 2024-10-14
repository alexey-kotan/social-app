{{-- тут хранится шаблон соновного html файла --}}
@extends('app')
{{-- секция для указания названия страницы --}}
@section('title')Смена пароля@endsection
{{-- секция, куда в основной шаблон html вставляется основной контент данной страницы (секцию нужно закрывать!) --}}
@section('content')
<h1>Смена пароля</h1>


<form action="{{ route('password.update') }}" method="post" autocomplete="off">
{{-- autocomplete - браузер не дает отправить форму, если поля не заполненны --}}
  @csrf
  {{-- <input type="hidden" name="token" value="{{ $request->token }}"> --}}


  <div class="form-floating">
    <input type="email" class="form-control" name="email" value="{{ old('email', $request->email) }}" required readonly id="email">
    {{-- readonly - не позволяет менять поле, но учитыввает данные в поле для отправки --}}
    <label for="floatingInput">Ваш Email</label>
  </div><br>
  
  <label for="floatingInput">Введите новый пароль</label>
  <div class="form-floating">
    <input type="password" class="form-control" name="password" required autofocus  id="password" placeholder="Password">
    <label for="floatingPassword">Новый пароль</label>
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
    <button class="btn btn-success w-100 py-2" type="submit">Сменить пароль</button>
  </form>
@endsection