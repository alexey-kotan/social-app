{{-- тут хранится шаблон соновного html файла --}}
@extends('app')
{{-- секция для указания названия страницы --}}
@section('title')Востановление пароля@endsection
{{-- секция, куда в основной шаблон html вставляется основной контент данной страницы (секцию нужно закрывать!) --}}
@section('content')
<h1>Восстановление пароля</h1>

<p>Введите свой Email</p>
<form action="{{ route('forgot') }}" method="post" autocomplete="off">
{{-- autocomplete - браузер не дает отправить форму, если поля не заполненны --}}
  @csrf
  <div class="form-floating">
    <input type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus id="email" placeholder="name@example.com">
    <label for="floatingInput">Email</label>
    
    @error('email')
      <p>{{ $message }}</p>
    @enderror

    @if(session('status')) 
    {{-- если в сессии есть status(успешная отправка из forgotcontroller), то отобразить сообщение --}}
      <p>Успешно! Сообщение о воосстановлении пароля отправленна вам на почту.</p>
    @endif

  </div></br>

    <button class="btn btn-success w-100 py-2" type="submit">Сбросить пароль</button>
  </form>
@endsection