@extends('layouts.app',[
'title'=>'Chat',
'searchbar'=>false,
'navbar'=>true
])
@section('content')
<div class="container marginBottom">
    <div class="row justify-content-center align-items-center">
        <div class="col-12">
            <h1 class="font-weight-bold">
                Chat</h1>
        </div>
    </div>
    <div class="row justify-content-center align-items-center my-3 ">
        <div class="col-12">
            <div id="items">
                @foreach ($chat as $item)
                <div id="card{{$item->id}}">
                    <div class="cardRipple rounded p-2">
                        <a href="{{route('chat.room',['project'=>$item->project_id])}}" class="text-dark">
                            <div class="row justify-content-center align-items-center">
                                <div class="col-3 col-md-2 col-lg-1">
                                    <span class="dot sec3 text-white font-weight-bold text-center fade 
                                    {{$item->counter > 0 ? 'show' : ''}}">
                                        {{$item->counter < 10 ? $item->counter : '9+'}}</span>
                                    <img src="{{$item->name->details->photo ? $item->name->details->photo : asset('img/avatar_placeholder.png')}}"
                                        class=" img-fluid bg-light roundedCorner mx-auto d-block w-100">
                                </div>
                                <div class="col-9 col-md-10 col-lg-11 pl-0">
                                    <p class="pl-1 text-secondary float-right 
                                    {{$item->counter > 0 ? 'font-weight-bold' : ''}}">
                                        {{isset($item->last_message->time) ? $item->last_message->time : ''}}
                                    </p>
                                    <h4 class="h4 my-0 {{$item->counter > 0 ? 'font-weight-bold' : ''}}">
                                        {{$item->project->title}}</h4>
                                    <p
                                        class="text-secondary my-0 text-truncate {{$item->counter > 0 ? 'font-weight-bold' : ''}}">
                                        {{isset($item->last_message->message) ? $item->last_message->message : ''}}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <hr class="bg-light">
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        function unread() {
            $.ajax({
                url: '{{route("chat.unread")}}',
                type: 'GET',
                dataType: 'JSON',
                success: function (data) {
                    if (data.status == 200) {
                        data.data.forEach(element => {
                            if ($("#card" + element.id).length) {
                                $("#card" + element.id).remove()
                            }
                            var html = `<div id="card` + element.id + `">
                                <div class="cardRipple rounded p-2">
                                <a href="chat/` + element.project_id + `" class="text-dark">
                                    <div class="row justify-content-center align-items-center cardRipple rounded">
                                        <div class="col-3 col-md-2 col-lg-1">
                                            <span class="dot sec3 text-white font-weight-bold text-center">
                                                ` + (element.counter < 10 ? element.counter : '9+') + `
                                                </span>
                                            <img src="` + (element.name.details.photo ||
                                'img/avatar_placeholder.png') + `"
                                                class=" img-fluid bg-light roundedCorner mx-auto d-block w-100">
                                        </div>
                                        <div class="col-9 col-md-10 col-lg-11 pl-0">
                                            <p class="pl-1 text-secondary float-right font-weight-bold">
                                                ` + element.last_message.time + `</p>
                                            <h4 class="h4 my-0 font-weight-bold">
                                                ` + element.project.title + `</h4>
                                            <p
                                                class="text-secondary my-0 text-truncate font-weight-bold">
                                                ` + element.last_message.message + `</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                                <hr class="bg-light">
                                </div>`
                            $('#items').prepend(html)
                        });

                    } else {
                        console.log(data);
                    }
                }
            });
        }
        $(document).ready(function () {
            unread();
            setInterval(unread, 5000);
        })

    </script>
    @endsection
