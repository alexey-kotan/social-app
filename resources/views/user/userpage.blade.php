{{-- тут хранится шаблон соновного html файла --}}
@extends('app')
{{-- секция для указания названия страницы --}}
@section('title') {{ $user->name }} @endsection
{{-- секция, куда в основной шаблон html вставляется основной контент данной страницы (секцию нужно закрывать!) --}}

@section('content')

  @include('blocks.user_info')
  
  @active
  @if(Auth::user() ==  $user)
    <form action="{{ route('edit_profile') }}">
        @csrf
        <button class="btn btn-light w-45 py-1 mb-2 mt-3" type="submit">Редактировать профиль</button>
    </form>
  @endif

  <p class="mb-6 mt-6 ml-3 d-flex align-items-center "><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-people mr-2" viewBox="0 0 16 16">
    <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8Zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816ZM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z"/>
    </svg> {{ $subscriptionCount }} 
  </p>
  
  @if(session('success_post'))
    <span class="badge bg-success-subtle text-success-emphasis rounded-pill mt-4 mb-4">{{ session('success_post') }}</span>
  @endif

  <p class="text-gray-700 font-medium text-xl"> Мои посты </p>

  <form action="{{ route('newpost') }}">
    @csrf
    <button class="btn btn-primary w-80 py-2 mb-2 mt-2" type="submit">Новый пост</button>
  </form>

  @if($posts->isEmpty())
    <p>У вас нет постов. Создайте <a href="{{ route('newpost') }}">новый пост</a>.</p> 
  @else
    @include('blocks.posts')
  @endif

  <form action="{{ route('my_posts') }}">
    @csrf
    <button class="btn btn-primary w-50 py-2 float-right mb-8" type="submit">Все мои посты</button>
  </form>
  @endactive

  @banned
    <p class="mb-3"><b>Страница заблокиролванна.</b></p>
    <form method="post" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="btn btn-dark rounded-pill px-3k">Выйти из аккаунта</button>
    </form>

    @if(session('ban_error'))
      <span class="badge bg-danger-subtle text-success-emphasis rounded-pill mt-4 mb-4">{{ session('ban_error') }}</span>
    @endif
  @endbanned

@endsection