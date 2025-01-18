{{-- тут хранится шаблон соновного html файла --}}
@extends('app')
{{-- секция для указания названия страницы --}}
@section('title')Редактор профиля {{ Auth::user()->name }} @endsection
{{-- секция, куда в основной шаблон html вставляется основной контент данной страницы (секцию нужно закрывать!) --}}

@section('content')

@if(session('success_edit'))
  <span class="badge bg-success-subtle text-success-emphasis rounded-pill mt-4 mb-4">{{ session('success_edit') }}</span>
@endif

  <div class="dropdown flex items-center">
    <img class="rounded-circle me-1" width="100" height="100" src="{{ asset('storage/' . Auth::user()->avatar) }}" alt=""> 
    <span class="text-gray-700 font-medium text-2xl">{{ Auth::user()->name }} </span>
  </div><br>

    @error('avatar_image')
      <span class="badge bg-danger-subtle text-danger-emphasis rounded-pill">{{ $message }}</span>
    @enderror

  <form action="{{ route('edit_avatar') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label for="formFile" class="form-label">Добавьте изображение к посту</label>
      <input class="form-control" type="file" id="avatar_image" name="avatar_image" accept="image/*">
    </div>

    <button class="btn btn-primary w-80 py-2" type="submit">Сменить аватар</button>
  </form>

@endsection