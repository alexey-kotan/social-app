<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- ??? --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <title>@yield('title')</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" 
    rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
    crossorigin="anonymous">
      <!-- Tailwind CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" 
    rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/js/app.js']) 
</head>

<body>

    @guest
        @include('blocks.header')
    @endguest

    <div class="flex min-h-screen bg-gray-200">
        @auth
            @active
                @admin
                    <div class="hidden lg:block w-3/12 sticky top-0 h-screen overflow-y-auto">
                        @include('admin.sidebar')
                    </div>
                    
                    @include('admin.sidebar_for_mobile')
                @endadmin

                @user
                    {{-- сайдбар доступен только авторизированным пользователям --}}
                    <div class="hidden lg:block w-3/12 sticky top-0 h-screen overflow-y-auto">
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
                    <div class="hidden lg:block w-3/12 sticky top-0 h-screen overflow-y-auto">
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
