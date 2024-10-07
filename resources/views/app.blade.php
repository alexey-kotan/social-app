<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    
@include('blocks.header')

<div class="container mt-5">
    <div class="row">
        <div class="col-8">
            {{-- сюда вставляется основной контент страницы, в которой используется данный шаблон html --}}
            @yield('content')
        </div>
    </div>
</div>

@include('blocks.footer')

</body>
</html>
