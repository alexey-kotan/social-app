{{-- тут хранится шаблон соновного html файла --}}
@extends('app')
{{-- секция для указания названия страницы --}}
@section('title') Новый пост @endsection
{{-- секция, куда в основной шаблон html вставляется основной контент данной страницы (секцию нужно закрывать!) --}}

@section('content')

<h3>Новый пост</h3><br>
<form action="{{ route('post_create') }}" method="post" enctype="multipart/form-data" autocomplete="off">
  @csrf

  {{-- отображение ошибок --}}
  @if(session('success'))
    <span class="badge bg-success-subtle text-success-emphasis rounded-pill mt-4 mb-4">{{ $message }}</span>
  @endif
  
  <div class="mb-3">
    <label for="exampleFormControlTextarea1" class="form-label">Что у вас нового? Введите сюда текст нового поста.</label>
    <textarea class="form-control" id="post_text" name="post_text"  required autofocus rows="3"></textarea>

    @error('post_text')
      <span class="badge bg-danger-subtle text-danger-emphasis rounded-pill">{{ $message }}</span>
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