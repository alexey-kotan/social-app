{{-- тут хранится шаблон соновного html файла --}}
@extends('app')
{{-- секция для указания названия страницы --}}
@section('title') Новый пост @endsection
{{-- секция, куда в основной шаблон html вставляется основной контент данной страницы (секцию нужно закрывать!) --}}

@section('content')

  <p class="font-bold d-flex mt-3 mb-3"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-postcard mr-1" viewBox="0 0 16 16">
    <path fill-rule="evenodd" d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2ZM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4Zm7.5.5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7ZM2 5.5a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1H2.5a.5.5 0 0 1-.5-.5Zm0 2a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1H2.5a.5.5 0 0 1-.5-.5Zm0 2a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1H2.5a.5.5 0 0 1-.5-.5ZM10.5 5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3ZM13 8h-2V6h2v2Z"/>
  </svg>Новый пост</h3>

  <form action="{{ route('post_create') }}" method="post" enctype="multipart/form-data" autocomplete="off">
    @csrf

    {{-- отображение ошибок --}}
    @if(session('success'))
      <span class="badge bg-success-subtle text-success-emphasis rounded-pill mt-4 mb-4">{{ $message }}</span>
    @endif
    
    <div class="mb-3">
      <label for="exampleFormControlTextarea1" class="form-label">Что у вас нового?</label>
      <textarea class="form-control" id="post_text" name="post_text"  required autofocus rows="3"></textarea>

      @error('post_text')
        <span class="badge bg-danger-subtle text-danger-emphasis rounded-pill">{{ $message }}</span>
      @enderror
    </div>

    <div class="mb-3">
      <label for="formFile" class="form-label">Добавьте изображение к посту</label>
      <input class="form-control" type="file" id="post_image" name="post_image" accept="image/*">

      @error('post_image')
      <p>{{ $message }}</p>
      @enderror
    </div>

    <button class="btn btn-success w-100 py-2" type="submit">Опубликовать</button>
  </form>

@endsection