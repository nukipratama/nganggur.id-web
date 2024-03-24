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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
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
    {{-- <script type="module" src="{{ resource_path('js/readmore.js')}}"></script>
    <script type="module" src="{{ resource_path('js/select2.js')}}"></script>
    <script type="module" src="{{ resource_path('js/swalForm.js')}}"></script> --}}
</body>

</html>
