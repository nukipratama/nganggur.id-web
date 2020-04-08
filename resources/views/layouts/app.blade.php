<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('layouts.favicon')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
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

<body style="background:url({{asset('img/wave.svg')}}) no-repeat fixed top;background-color:#F2F2FA;">

    <div id="app">
        <form action="{{route('logout')}}" method="POST">
            @csrf
            <button type="submit">logout</button>
        </form>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>