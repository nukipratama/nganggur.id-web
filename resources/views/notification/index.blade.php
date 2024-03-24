@extends('layouts.app',[
'title'=>'Notifikasi',
'searchbar'=>false,
'navbar'=>true
])
@section('content')
<style>


</style>
<div class="container marginBottom">
    <div class="row justify-content-center align-items-center">
        <div class="col-12">
            <h1 class="font-weight-bold">
                Notifikasi</h1>
        </div>
    </div>
    <div class="row justify-content-center align-items-center my-3 ">
        <div class="col-12">
            <div id="items">
                @foreach ($notification as $item)
                <a href="{{$item->target}}" class="text-dark ">
                    <div class="row justify-content-center align-items-center cardRipple rounded">
                        <div class="col-3 col-md-1">
                            <img src="{{$item->icon}}" class=" img-fluid bg-light rounded mx-auto d-block w-100">
                        </div>
                        <div class="col-9 col-md-11 pl-0">
                            @if ($item->read === 0)
                            <span class="dot2 sec2 text-white font-weight-bold"></span>
                            @endif
                            <p class="pl-1 text-secondary float-right">
                                {{Carbon\Carbon::parse($item->created_at)->format('d/m')}}
                            </p>
                            <p class="font-weight-bold my-0">{{$item->title}}</p>
                            <p class="text-secondary my-0">{{$item->description}}</p>
                        </div>
                    </div>
                </a>
                <hr class="bg-light">
                @endforeach
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        {{ $notification->links() }}
    </div>
    <script type="module">
        function request() {
            function dot(count) {
                if (count === 0) {
                    return '<span class="dot2 sec2 text-white font-weight-bold"></span>'
                } else {
                    return ''
                }
            }
            $.ajax({
                type: 'GET',
                url: '{{route("notification.unread")}}',
                dataType: 'json',
                success: function (data) {
                    data.forEach(element => {
                        var time = new Date(element['created_at']);
                        var d = time.getDate() + "/" + (time.getMonth() + 1);
                        var content = `<a href="` + element['target'] + `" class="text-dark ">
            <div class="row justify-content-center align-items-center cardRipple rounded">
            <div class="col-3 col-md-1">
            <img src="` + element['icon'] + `" class="img-fluid bg-light rounded mx-auto d-block w-100">
            </div>
            <div class="col-9 col-md-11 pl-0">
               ` + dot(element['read']) + `
            <p class="pl-1 text-secondary float-right">` + d.toString() + `</p>
            <p class="font-weight-bold my-0">` + element['title'] + `</p>
            <p class="text-secondary my-0">` + element['description'] + `</p>
            </div>
            </div>
            </a>
            <hr class="bg-light">`;
                        $(content).prependTo('#items');
                    });
                },
                error: function () {
                }
            });
        }
        setInterval(request, 5000);
    </script>

    @endsection
