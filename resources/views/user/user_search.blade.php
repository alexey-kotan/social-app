{{-- тут хранится шаблон соновного html файла --}}
@extends('app')
{{-- секция для указания названия страницы --}}
@section('title') Поиск пользователей @endsection
{{-- секция, куда в основной шаблон html вставляется основной контент данной страницы (секцию нужно закрывать!) --}}

@section('content')
    <p class="mb-8">Поиск пользователей</p>

    <div class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
        <form action="{{ route('user_search') }}" method="GET">
            @csrf
            <input type="text" class="mb-2 form-control" name="search" placeholder="Введите ID или никнейм пользователя для поиска" aria-label="Search">
            <button class="btn btn-primary w-40 py-2 mb-12" type="submit">Поиск</button>
        </form>
    </div>

    @if(isset($users)) 
        <div class="search-results">
            @foreach($users as $user)
                <div class="col-md-12 bg-blue-100">
                    <div class="row border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-350 position-relativeц">
                        <div class="col-auto d-none d-lg-block mt-2 mb-2">
                            <a href="{{ route('user_profile', ['id' => $user->id]) }}"><img src="{{asset('storage/' . $user->avatar) }}" width="50" height="50" alt=""></a>
                        </div>
                        
                        <div class="col p-6 d-flex flex-column">
                            <a href="{{ route('user_profile', ['id' => $user->id]) }}" class="text-blue-600 hover:underline">{{ $user->name }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

@endsection