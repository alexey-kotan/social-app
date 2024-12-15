{{-- тут хранится шаблон соновного html файла --}}
@extends('app')
{{-- секция для указания названия страницы --}}
@section('title')Авторизация@endsection
{{-- секция, куда в основной шаблон html вставляется основной контент данной страницы (секцию нужно закрывать!) --}}

@section('content')
<div class="dropdown">
    <form action="{{ route('userpage') }}">
      <button type="submit" class="badge d-flex align-items-center p-2 pe-2 text-dark-emphasis bg-light-subtle border border-dark-subtle rounded-pill">
        <img class="rounded-circle me-1" width="100" height="100" src="cat1.png" alt="">&nbsp;&nbsp; <h1>{{ Auth::user()->name }}</h1>
        {{-- Auth::user() - используется, чтобы считать авторизованного пользователя --}}
      </button>
    </form>
  </div><br>
  <h5>Мои посты</h5>

  <form action="{{ route('newpost') }}">
    <button class="btn btn-primary w-50 py-2" type="submit">Новый пост</button>
  </form>

  @if(session('success_post'))
  <p>{{ session('success_post') }}</p>
  @endif <br>

  <div class="col-md-6">
    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
      <div class="col p-4 d-flex flex-column position-static">
        <strong class="d-inline-block mb-2 text-success-emphasis">Design</strong>
        <h3 class="mb-0">Post title</h3>
        <div class="mb-1 text-body-secondary">Nov 11</div>
        <p class="mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
        <a href="#" class="icon-link gap-1 icon-link-hover stretched-link">
          Continue reading
          <svg class="bi"><use xlink:href="#chevron-right"></use></svg>
        </a>
      </div>
      <div class="col-auto d-none d-lg-block">
        <img src="" alt="">
        <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
      </div>
    </div>
  </div>
  <p>Пост 2</p>
  <p>Пост 3</p>

@endsection