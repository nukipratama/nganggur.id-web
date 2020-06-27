<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('layouts.favicon')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? '' }} - nganggur.id</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- Styles -->
    <link rel="preload" href="{{ asset('css/app.min.css') }}" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>

<body>
    <script src="{{ asset('js/app.min.js') }}"></script>
    @include('sweetalert::alert')
    <div id="app">
        <main>
            @includeWhen($searchbar,'layouts.searchbar')
            @includeWhen($navbar,'layouts.navbar')
            <div class="pt-4">
                @yield('content')
            </div>
        </main>
    </div>
    <script src="{{asset('js/readmore.js')}}"></script>
    <script src="{{asset('js/select2.js')}}"></script>
    <script src="{{asset('js/swalForm.js')}}"></script>
</body>

</html>
