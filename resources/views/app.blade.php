<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

@guest
    @include('blocks.header')
@endguest

<div class="flex flex-row">
    <div class="basis-3/10">
        @auth
        {{-- сайдбар доступен только авторизированным пользователям --}}
            @include('blocks.sidebar')
        @endauth
    </div>

    <div class="basis-4/10">
        <div class="container">
            {{-- сюда вставляется основной контент страницы, в которой используется данный шаблон html --}}
            @yield('content')
        </div>
    </div>

    <div class="basis-3/10">
        @auth
        {{-- друзья доступны только авторизированным пользователям --}}
        <h4>Мои друзья</h4>
        @endauth
    </div>
</div>

</body>
</html>
