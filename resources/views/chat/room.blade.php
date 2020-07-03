@extends('layouts.app',[
'title'=>$chat->project->title.' - Chat',
'searchbar'=>false,
'navbar'=>false
])
@section('content')
<style>
    .message-content-right {
        border-radius: 15px 0 15px 15px !important;
        max-width: 70%;
    }

    .message-content-left {
        border-radius: 0 15px 15px 15px !important;
        max-width: 70%;
    }

</style>

<div class="fixed-top bg-white py-3 border-bottom ">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-2 col-md-1 pr-0">
                <a href="{{Session::has('chat') ? Session::pull('chat') : url()->previous() }}">
                    <span class="material-icons text-dark" style="font-size:2rem">arrow_back</span>
                </a>
            </div>
            <div class="col-2 col-md-1">
                <img src="{{$chat->name->details->photo ? $chat->name->details->photo : asset('img/avatar_placeholder.png')}}"
                    class="img-fluid rounded-circle">
            </div>
            <div class="col-8 pl-0">
                <h6>{{$chat->project->title}}</h6>
                <h4 class="font-weight-bold">{{$chat->name->name}}</h4>
            </div>
        </div>
    </div>
</div>

<div class="container marginBottom" style="margin-top: 12vh">
    @if ($chat->chats)
    @foreach (json_decode($chat->chats) as $item)
    @if ($item->user_id === Auth::id())
    <div class="d-flex justify-content-end my-4 ">
        <div class="px-3 pt-3 message-content-right shadow-sm bg-primary text-white">
            <p class="mb-1 font-weight-bold text-break">{{$item->message}}</p>
            <p class="text-right">
                {{Carbon\Carbon::parse($item->timestamp)->isToday() ? Carbon\Carbon::parse($item->timestamp)->timezone(config('app.timezone'))->format('H:i') : Carbon\Carbon::parse($item->timestamp)->timezone(config('app.timezone'))->format('d/m')}}
            </p>
        </div>
        <img src="{{Auth::user()->details->photo ? Auth::user()->details->photo : asset('img/avatar_placeholder.png')}}"
            class="img-fluid rounded-circle p-2 d-none d-md-block" style="max-width: 50px; max-height:50px;">
    </div>
    @else
    <div class="d-flex justify-content-start my-4">
        <img src="{{$chat->name->details->photo ? $chat->name->details->photo : asset('img/avatar_placeholder.png')}}"
            class="img-fluid rounded-circle p-2 d-none d-md-block" style="max-width: 50px; max-height:50px">
        <div class="px-3 pt-3 message-content-left shadow-sm bg-white">
            <p class="mb-1 font-weight-bold text-break">{{$item->message}}</p>
            <p class="text-left">
                {{Carbon\Carbon::parse($item->timestamp)->isToday() ? Carbon\Carbon::parse($item->timestamp)->timezone(config('app.timezone'))->format('H:i') : Carbon\Carbon::parse($item->timestamp)->timezone(config('app.timezone'))->format('d/m')}}
            </p>
        </div>
    </div>
    @endif
    @endforeach
    @endif
    <div id="chat_bottom" class="mb-5"></div>
</div>

@if ($chat->project->status_id === 3)
<nav class="navbar fixed-bottom navbar-light bg-white shadow-lg py-2 border-top">
    <div class="row justify-content-center align-items-center" style="width:100vw;">
        <div class="col-10 col-lg-7 pr-0">
            <textarea id="input_message" name="message" class="form-control roundedCorner border-0"
                placeholder="Masukkan Pesan.." rows="1"
                oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"' data-autosize="true"
                style="max-height: 15vh;color: rgb(90, 90, 90);background-color: #e5eef0;resize: none;"></textarea>
        </div>
        <div class="col-2 col-lg-1 p-0 text-center" id="send_btn">
            <span class="material-icons text-dark" style="font-size:2rem">send</span>
        </div>
    </div>
</nav>
@endif



<script>
    function send() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var messages = $("#input_message").val();
        if (messages == "") {
            return true;
        }
        $.ajax({
            url: '{{route("chat.send",["project"=>$chat->project->id])}}',
            type: 'POST',
            data: {
                _token: CSRF_TOKEN,
                message: messages
            },
            dataType: 'JSON',
            success: function (data) {
                if (data.status == 200) {
                    $("#input_message").val('');
                    $("#input_message").attr("style",
                        'max-height: 15vh;color: rgb(90, 90, 90);background-color: #e5eef0;resize: none;'
                    );
                    var today = new Date();
                    var time = today.getHours() + ":" + today.getMinutes()
                    var html =
                        `<div class="d-flex justify-content-end my-4">
                            <div class="px-3 pt-3 message-content-right shadow-sm bg-primary text-white">
                                <p class="mb-1 font-weight-bold text-break">` + messages + `</p>
                                <p class="text-right">` + time + `</p>
                            </div>
                            <img src="{{Auth::user()->details->photo ? Auth::user()->details->photo : asset('img/avatar_placeholder.png')}}"
                                class="img-fluid rounded-circle p-2 d-none d-md-block" style="max-width: 50px; max-height:50px">
                             </div>`;
                    $(html).insertBefore("#chat_bottom");
                    $("html, body").animate({
                        scrollTop: $(document).height()
                    }, "fast");
                } else {
                    location.reload();
                }
            }
        });
    }

    function get() {
        $.ajax({
            url: '{{route("chat.get",["project"=>$chat->project->id])}}',
            type: 'GET',
            dataType: 'JSON',
            success: function (data) {
                if (data.status == 200) {
                    data.chats.forEach(element => {
                        var today = new Date();
                        var time = today.getHours() + ":" + today.getMinutes()
                        var html =
                            `<div class="d-flex justify-content-start my-4">
                        <img src="{{$chat->name->details->photo ? $chat->name->details->photo : asset('img/avatar_placeholder.png')}}"
                            class="img-fluid rounded-circle p-2 d-none d-md-block" style="max-width: 50px; max-height:50px">
                        <div class="px-3 pt-3 message-content-left shadow-sm bg-white">
                            <p class="mb-1 font-weight-bold text-break">` + element.message + `</p>
                            <p class="text-left">` + time + `</p>
                        </div>
                        </div>`;
                        $(html).insertBefore("#chat_bottom");
                        $("html, body").animate({
                            scrollTop: $(document).height()
                        }, "fast");
                    });
                } else {
                    console.log(data);
                }
            }
        });
    }
    $(document).ready(function () {
        $("html, body").animate({
            scrollTop: $(document).height()
        }, "fast");
        setInterval(get, 5000);
        $('#send_btn').click(function () {
            send();
        })
    })

</script>
@endsection
