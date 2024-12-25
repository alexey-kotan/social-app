{{-- тут хранится шаблон соновного html файла --}}
@extends('app')
{{-- секция для указания названия страницы --}}
@section('title') {{ Auth::user()->name }} @endsection
{{-- секция, куда в основной шаблон html вставляется основной контент данной страницы (секцию нужно закрывать!) --}}

@section('content')
  <div class="dropdown flex items-center">
    <img class="rounded-circle me-1" width="100" height="100" src="defolt.png" alt=""> 
    <span class="text-gray-700 font-medium text-2xl">{{ Auth::user()->name }} </span>
  </div><br>

  <span class="text-gray-700 font-medium text-xl"> Мои посты </span>

  <form action="{{ route('newpost') }}">
    <button class="btn btn-primary w-80 py-2" type="submit">Новый пост</button>
  </form>

  @if(session('success_post'))
  <p>{{ session('success_post') }}</p>
  @endif <br>

  @if($posts->isEmpty())
    <p>У вас нет постов. Создайте <a href="{{ route('newpost') }}">новый пост</a>.</p> 
  @else
    @foreach($posts as $post)
      <div class="col-md-12 bg-gray-100">
        <div class="row border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-350 position-relativeц">
          <div class="col-auto d-none d-lg-block mt-2 mb-2">
            @if($post->post_image !== null)
                <a href="{{ asset('storage/' . $post->post_image) }}" target="_blank">
                <img src="{{ asset('storage/' . $post->post_image) }}" width="200" height="200" alt="">
                </a>
            @endif
          </div>
          <div class="col p-6 d-flex flex-column">
            <div class="mb-1 text-body-secondary">Опубликовал <b>{{ $post->user_name }}</b> в {{ $post->created_at }}</div>
            <p class="mb-auto">{{ $post->post_text }}</p>
          </div>
        </div>
      </div>
    @endforeach
  @endif

  <form action="{{ route('my_posts') }}">
    <button class="btn btn-primary w-50 py-2 float-right" type="submit">Все мои посты</button>
  </form>
</br>

@endsection