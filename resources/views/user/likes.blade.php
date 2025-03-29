{{-- тут хранится шаблон соновного html файла --}}
@extends('app')
{{-- секция для указания названия страницы --}}
@section('title') Поставленные лайки на пост @endsection
{{-- секция, куда в основной шаблон html вставляется основной контент данной страницы (секцию нужно закрывать!) --}}

@section('content')

  <p class="mt-2 ml-2 mb-2 d-flex align-items-center"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill mr-2" viewBox="0 0 16 16">
    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
    </svg> Лайки на посте
  </p>


  <div class="container mx-auto">
    <div class="flex flex-wrap">
      @foreach ($likes as $like)  
       <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 p-1 flex">  <!-- Адаптивные размеры -->
          <div class="bg-blue-100 rounded-full h-16 w-32 flex items-center justify-center shadow-lg"> <!-- Фиксированная высота -->
            <a href="/id_{{$like->user->id}}">
                <img src="{{ asset('storage/' . $like->user->avatar) }}" class="rounded-full w-12 h-12 object-cover" alt=""> <!-- Фиксированные размеры аватарки -->
            </a>
            <a href="/id_{{$like->user->id}}" class="ml-3 text-black-600 hover:underline">{{ $like->user->name }}</a>
          </div>
        </div>
      @endforeach
    </div>
  </div>


@endsection