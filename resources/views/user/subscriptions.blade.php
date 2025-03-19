{{-- тут хранится шаблон соновного html файла --}}
@extends('app')
{{-- секция для указания названия страницы --}}
@section('title') Мои подписки @endsection
{{-- секция, куда в основной шаблон html вставляется основной контент данной страницы (секцию нужно закрывать!) --}}

@section('content')

  <p class="font-bold d-flex mt-3 mb-3"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-people-fill mr-1" viewBox="0 0 16 16">
    <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
  </svg>Мои подписки</p>

  @if(Auth::user()->subscriptions->isEmpty())
        <p>У вас нет подписок.</p> 
  @else

  <div class="container mx-auto">
    <div class="flex flex-wrap">
      @foreach ($subscriptions as $subscription)  
       <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 p-1 flex">  <!-- Адаптивные размеры -->
          <div class="bg-blue-100 rounded-full h-16 w-32 flex items-center justify-center shadow-lg"> <!-- Фиксированная высота -->
            <a href="/id_{{$subscription->id}}">
                <img src="{{ asset('storage/' . $subscription->avatar) }}" class="rounded-full w-12 h-12 object-cover" alt=""> <!-- Фиксированные размеры аватарки -->
            </a>
            <a href="/id_{{$subscription->id}}" class="ml-3 text-black-600 hover:underline">{{ $subscription->name }}</a>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  @endif

  @if($posts->isNotEmpty())
  <p class="font-bold d-flex mt-3 mb-3"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-postcard mr-1" viewBox="0 0 16 16">
    <path fill-rule="evenodd" d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2ZM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4Zm7.5.5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7ZM2 5.5a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1H2.5a.5.5 0 0 1-.5-.5Zm0 2a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1H2.5a.5.5 0 0 1-.5-.5Zm0 2a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1H2.5a.5.5 0 0 1-.5-.5ZM10.5 5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3ZM13 8h-2V6h2v2Z"/>
  </svg>Посты ваших подписок</p>
    @include('blocks.posts')
  @endif


@endsection