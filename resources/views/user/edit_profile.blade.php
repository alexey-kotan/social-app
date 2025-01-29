{{-- тут хранится шаблон соновного html файла --}}
@extends('app')
{{-- секция для указания названия страницы --}}
@section('title')Редактор профиля {{ Auth::user()->name }} @endsection
{{-- секция, куда в основной шаблон html вставляется основной контент данной страницы (секцию нужно закрывать!) --}}

@section('content')

@if(session('success_edit'))
  <span class="badge bg-success-subtle text-success-emphasis rounded-pill mt-4 mb-4">{{ session('success_edit') }}</span>
@endif

<div class="flex mt-3 mb-3">
  <div class="w-1/2 mx-auto">
    <div class="dropdown flex items-center">
      <img class="rounded-circle me-1 mr-2" width="100" height="100" src="{{ asset('storage/' . Auth::user()->avatar) }}" alt=""> 
      <span class="text-gray-700 font-medium text-2xl">{{ Auth::user()->name }} </span>
    </div>
  </div>
  <div class="w-1/2 mx-auto lg:block hidden">
    <p><b>БИО:</b> {{ Auth::user()->bio }}</p>
  </div>
</div>

@error('name')
  <span class="badge bg-danger-subtle text-success-emphasis rounded-pill mt-4 mb-4">{{ $message }}</span>
@enderror


  <form action="{{ route('edit_name') }}" method="POST"> 
    @csrf
    <label for="formFile" class="form-label d-flex"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-circle mr-2" viewBox="0 0 16 16">
      <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
      <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
      </svg> Сменить имя
    </label> 
    <div class="form-floating mb-2">
      <input type="name" class="form-control mb-3" name="name" value="{{ old('name') }}" id="name" placeholder="name">
      <label for="floatingInput">Имя пользователя</label>
      <button class="btn btn-primary w-80 py-2 mb-2" type="submit">Сменить имя</button>
    </div>
  </form>

  @error('avatar_image')
    <span class="badge bg-danger-subtle text-danger-emphasis rounded-pill mb-2">{{ $message }}</span>
  @enderror

  <form action="{{ route('edit_avatar') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label for="formFile" class="form-label d-flex"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-bounding-box mr-2" viewBox="0 0 16 16">
        <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z"/>
        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
      </svg> Загрузить новый аватар
      </label>
      <input class="form-control" type="file" id="avatar_image" name="avatar_image" accept="image/*">
    </div>
    <button class="btn btn-primary w-80 py-2" type="submit">Сменить аватар</button>
  </form>
  
  <div class="lg:block hidden">
    @error('bio_text')
      <span class="badge bg-danger-subtle text-danger-emphasis rounded-pill mt-2">{{ $message }}</span>
    @enderror

    <form action="{{ route('edit_bio') }}" method="POST">
      @csrf
      <div class="mt-3 mb-3">
        <label for="formFile" class="form-label d-flex"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-file-text mr-2" viewBox="0 0 16 16">
          <path d="M5 4a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1H5z"/>
          <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
          </svg> Расскажите о себе в БИО
        </label>
        <textarea class="form-control" id="bio_text" name="bio_text"  required rows="3" placeholder="Максимальное количество символов: 450"></textarea>
      </div>
      <button class="btn btn-primary w-80 py-2" type="submit">Редактировать БИО</button>
    </form>
  </div>
@endsection