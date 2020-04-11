<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('layouts.favicon')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? '' }} - nganggur.id</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

</head>

<body style="background:url({{asset('img/wave.svg')}}) no-repeat fixed top;background-color:#f5f5f5;">
    <div id="app">
        <main>
            @if (Auth::check())
            @include('layouts.verify')
            @includeWhen($navbar,'layouts.navbar')
            <form action="{{route('logout')}}" method="POST">
                @csrf
                <button type="submit">logout</button>
            </form>
            @endif
            <div class="py-4" style="margin-bottom:10vh ">
                @yield('content')
            </div>
        </main>
    </div>
</body>

</html>