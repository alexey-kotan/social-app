{{-- тут хранится шаблон соновного html файла --}}
@extends('app')
{{-- секция для указания названия страницы --}}
@section('title') {{ $user->name }} @endsection
{{-- секция, куда в основной шаблон html вставляется основной контент данной страницы (секцию нужно закрывать!) --}}

@section('content')

  <div class="flex mt-3 mb-3">
    <div class="w-1/2">
      <div class="dropdown flex items-center">
        <img class="rounded-circle me-1 mr-2" width="100" height="100" src="{{ asset('storage/' . $user->avatar) }}" alt=""> 
        <span class="text-gray-700 font-medium text-2xl">{{ $user->name }}</span>
          @if($user->role == 'admin') 
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill ml-2" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
              </svg> 
          @endif 
      </div>
  </div>
    @if($user->bio)
      <div class="w-1/2 mx-auto lg:block hidden">
        <p><b>БИО:</b> {{ $user->bio }}</p>
      </div>
    @endif
  </div>
  @if($user->status == 'active')
    <form action="{{ route('user_subscribers', ['id' => $user->id]) }}">
      <button class="mb-6 mt-6 ml-3 d-flex align-items-center" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-people mr-2" viewBox="0 0 16 16">
        <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8Zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816ZM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z"/>
        </svg> {{ $subscriptionCount }} 
      </button>
    </form>
  
      
    @include('blocks.subscribe_block')

    @if(session('success_subscribe'))
      <span class="badge bg-success-subtle text-success-emphasis rounded-pill mt-4 mb-4">{{ session('success_subscribe') }}</span>
    @endif

    <a href="{{ route('chat', $user->id) }}" class="text-indigo-600 hover:text-indigo-800">Send message</a>

    <span class="text-gray-700 font-medium text-xl">Посты пользователя <i>{{ $user->name }}</i></span><br>

    @if($posts->isEmpty())
      <p>У пользователя <i>{{ $user->name }}</i> нет постов.</p> 
    @else

      @include('blocks.posts')
      
      <form action="{{ route('user_posts', ['id' => $user->id]) }}">
        @csrf
        <button class="btn btn-primary w-50 py-2 float-right mb-2" type="submit">Все посты {{ $user->name }}</button>
      </form></br>
    @endif
  @else

    <p class="mb-3"><b>Страница заблокиролванна.</b></p>

        @include('blocks.subscribe_block')

    @if(session('success_subscribe'))
      <span class="badge bg-success-subtle text-success-emphasis rounded-pill mt-4 mb-4">{{ session('success_subscribe') }}</span>
    @endif <br>
  @endif
@endsection