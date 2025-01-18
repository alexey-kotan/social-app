{{-- тут хранится шаблон соновного html файла --}}
@extends('app')
{{-- секция для указания названия страницы --}}
@section('title') Мои подписки @endsection
{{-- секция, куда в основной шаблон html вставляется основной контент данной страницы (секцию нужно закрывать!) --}}

@section('content')

  <p class="font-bold">Мои подписки</p><br>

  @if(Auth::user()->subscriptions->isEmpty())
        <p>У вас нет подписок.</p> 
  @else
    @foreach (Auth::user()->subscriptions as $subscription)  
      <div class="col-md-12 bg-blue-100">
        <div class="row border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-350 position-relativeц">
            <div class="col-auto d-none d-lg-block mt-2 mb-2">
                <a href="/id_{{$subscription->id}}"><img src="{{ $subscription->avatar }}" width="50" height="50" alt=""></a>
            </div>
            
            <div class="col p-6 d-flex flex-column">
                <a href="/id_{{$subscription->id}}" class="text-blue-600 hover:underline">{{ $subscription->name }}</a>
            </div>
        </div>
      </div>
    @endforeach
  @endif

  @if($posts->isNotEmpty())
    <h2>Посты ваших подписок</h2>
    @include('blocks.posts')
  @endif


@endsection