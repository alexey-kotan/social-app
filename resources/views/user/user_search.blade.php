{{-- тут хранится шаблон соновного html файла --}}
@extends('app')
{{-- секция для указания названия страницы --}}
@section('title') Поиск пользователей @endsection
{{-- секция, куда в основной шаблон html вставляется основной контент данной страницы (секцию нужно закрывать!) --}}

@section('content')
    <p class="font-bold d-flex mt-3 mb-3"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search mr-2" viewBox="0 0 16 16">
        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
      </svg>Поиск пользователей</p>

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
                    <div class="row border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-350 position-relative">
                        <div class="col-auto d-lg-block mt-2 mb-2">
                            <a href="{{ route('user_profile', ['id' => $user->id]) }}"><img src="{{asset('storage/' . $user->avatar) }}" width="50" height="50" alt=""></a>
                        </div>
                        
                        <div class="col p-6 d-flex flex-column">
                            <a href="{{ route('user_profile', ['id' => $user->id]) }}" class="text-blue-600 hover:underline">{{ $user->name }}</a>
                        </div>
                        @admin
                            <div class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                                <form action="{{ route('ban_user') }}" method="GET">
                                    @csrf
                                    <button class="btn btn-dark w-40 py-2 mb-12" type="submit">Заблокировать</button>
                                </form>
                            </div>
                        @endadmin
                        @if(Auth::user() != $user)
                            <div class="p-6 d-flex flex-column">
                                @include('blocks.subscribe_block')
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif

@endsection