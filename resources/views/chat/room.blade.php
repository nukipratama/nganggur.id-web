@extends('layouts.app',[
'title'=>$chat->project->title.' - Chat',
'searchbar'=>false,
'navbar'=>false
])
@section('content')
<style>
    body {
        background: none;
    }

    .message-content-right {
        color: rgb(90, 90, 90);
        background-color: #e5eef0;

        border-radius: 15px 15px 0 15px !important;
        max-width: 70%;
    }

    .message-content-left {
        color: rgb(90, 90, 90);
        background-color: #eeeeee;
        border-radius: 15px 15px 15px 0 !important;
        max-width: 70%;
    }

</style>


<div class="container marginBottom">
    <div class="row align-items-center">
        <div class="col-2 pr-0">
            <a href="{{Session::has('chat') ? Session::pull('chat') : url()->previous() }}">
                <span class="material-icons text-dark" style="font-size:2rem">arrow_back</span>
            </a>
        </div>
        <div class="col-8 pl-0">
            <h6>{{$chat->project->title}}</h6>
            <h4 class="font-weight-bold">{{$chat->name->name}}</h4>
        </div>
    </div>
    <hr class="bg-light">

    <div class="d-flex justify-content-start my-4">
        <div class="px-3 pt-3 message-content-left ">
            <p class="mb-1 font-weight-bold">Lorem Ipsum is simply dummy text of the printing and
                typesetting
                industry.
                Lorem
                Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
            <p class="text-left">8 menit yang lalu</p>
        </div>
    </div>

    <div class="d-flex justify-content-end my-4">
        <div class="px-3 pt-3 message-content-right ">
            <p class="mb-1 font-weight-bold ">Lorem Ipsum is simply dummy text of the printing and
                typesetting
                industry.
                Lorem
                Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
                galley of type and scrambled it to make a type specimen book. </p>
            <p class="text-right">8 menit yang lalu</p>
        </div>
    </div>


</div>
<nav class="navbar fixed-bottom navbar-light bg-white shadow-lg py-2 border-top">
    <div class="row justify-content-center align-items-center" style="width:100vw;">
        <div class="col-10 col-md-7 pr-0">
            <textarea id="input_message" name="message" class="form-control roundedCorner border-0"
                placeholder="Masukkan Pesan.." rows="1"
                oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"' data-autosize="true"
                style="max-height: 15vh;color: rgb(90, 90, 90);background-color: #e5eef0;resize: none;"></textarea>
        </div>
        <div class="col-2 col-md-1 p-0 text-center" id="send_btn">
            <span class="material-icons text-dark" style="font-size:2rem">send</span>
        </div>
    </div>
</nav>
<script>
    $(document).ready(function () {
        $('#send_btn').click(function () {
            send();
        })
    })

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
                    console.log(data);
                    $("#input_message").val('');
                    $("#input_message").attr("style",
                        'max-height: 15vh;color: rgb(90, 90, 90);background-color: #e5eef0;resize: none;'
                    );
                } else {
                    console.log(data);

                    // location.reload();
                }
            }
        });
    }

</script>
@endsection
