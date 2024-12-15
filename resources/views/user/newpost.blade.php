{{-- тут хранится шаблон соновного html файла --}}
@extends('app')
{{-- секция для указания названия страницы --}}
@section('title')Авторизация@endsection
{{-- секция, куда в основной шаблон html вставляется основной контент данной страницы (секцию нужно закрывать!) --}}

@section('content')

<h3>Новый пост</h3><br>
<form action="{{ route('post_create') }}" method="post" enctype="multipart/form-data" autocomplete="off">
  @csrf

  {{-- отображение ошибок --}}
  @if(session('success'))
    <p>{{ $message }}</p>
  @endif
  
  <div class="mb-3">
    <label for="exampleFormControlTextarea1" class="form-label">Что у вас нового? Введите сюда текст нового поста.</label>
    <textarea class="form-control" id="post_text" name="post_text"  required autofocus rows="3"></textarea>

    @error('post_text')
    <p>{{ $message }}</p>
    @enderror
  </div></br>

  <div class="mb-3">
    <label for="formFile" class="form-label">Добавьте изображение к посту</label>
    <input class="form-control" type="file" id="post_image" name="post_image" accept="image/*">

    @error('post_image')
    <p>{{ $message }}</p>
    @enderror
  </div></br>

  <button class="btn btn-success w-100 py-2" type="submit">Опубликовать</button>
</form>

@endsection