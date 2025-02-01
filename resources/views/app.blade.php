<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    @guest
        @include('blocks.header')
    @endguest

    <div class="flex min-h-screen bg-gray-200">
        @auth
            @active
                @admin
                    <div class="hidden lg:block w-3/12">
                        @include('admin.sidebar')
                    </div>
                    
                    @include('admin.sidebar_for_mobile')
                @endadmin

                @user
                    {{-- сайдбар доступен только авторизированным пользователям --}}
                    <div class="hidden lg:block w-3/12">
                        @include('blocks.sidebar')
                    </div>
                    
                    
                    @include('blocks.sidebar_for_mobile')
                @enduser
            @endactive
        @endauth

            <div class="flex-1 w-full w-11/12 mx-auto">
                <div class="container ">
                    {{-- сюда вставляется основной контент страницы, в которой используется данный шаблон html --}}
                    @yield('content')
                </div>
            </div>
            
        @auth
            @active    
                @user
                    <div class="hidden lg:block w-3/12">
                        {{-- друзья доступны только авторизированным пользователям --}}
                        @include('blocks.subscriptions_bar')
                    </div>
                @enduser
            @endactive
        @endauth
    </div>

    @include('blocks.footer')
</body>
</html>
