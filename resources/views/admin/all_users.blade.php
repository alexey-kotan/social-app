{{-- тут хранится шаблон соновного html файла --}}
@extends('app')
{{-- секция для указания названия страницы --}}
@section('title') Все пользователи @endsection
{{-- секция, куда в основной шаблон html вставляется основной контент данной страницы (секцию нужно закрывать!) --}}

@section('content')

    @foreach($user as $user)
        <div class="col-md-12 bg-blue-100 mb-2">
            <div class="row border rounded overflow-hidden flex-row align-items-center mb-4 shadow-sm h-md-350 position-relative">
                <div class="col-auto d-lg-block mt-2 mb-2">
                    <a href="{{ route('user_profile', ['id' => $user->id]) }}">
                        <img src="{{ asset('storage/' . $user->avatar) }}" width="50" height="50" alt="">
                    </a>
                </div>
                <div class="col-auto">
                    <a href="{{ route('user_profile', ['id' => $user->id]) }}" class="text-blue-600 hover:underline">{{ $user->name }}</a>
                </div>
                <p class="mb-0 me-2">ID: <b>{{$user->id}}</b></p>
                <p class="mb-0 me-2">Email: <b>{{$user->email}}</b></p>
                <p class="mb-0 me-2">Роль: <b>{{$user->role}}</b></p>
                <p class="mb-0 me-2">Статус: <b>{{$user->status}}</b></p>
                <p class="mb-0 me-2">Дата регистрации: <b>{{$user->created_at}}</b></p>

                @if($user->status == 'active')
                    <div class="col-auto mt-3 mb-3">
                        <form action="{{ route('ban_user') }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <button class="btn btn-danger w-40 py-1" type="submit">Заблокировать и удалить посты пользователя</button>
                        </form>
                    </div>
                @else
                    <div class="col-auto mt-3 mb-3">
                        <form action="{{ route('unban_user') }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <button class="btn btn-success w-40 py-1" type="submit">Разблокировать</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>

    @endforeach

@endsection
