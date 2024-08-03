@extends('layouts.app',[
'title'=>'Pemberitahuan',
'searchbar'=>false,
'navbar'=>true
])
@section('content')
<style>
    .vertical-center {
        min-height: 70%;
        min-height: 70vh;
        display: flex;
        align-items: center;
    }

</style>
<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-12">
            <h1 class="font-weight-bold">
                Pemberitahuan</h1>
        </div>
    </div>
    <div class="row justify-content-center  align-items-center text-center vertical-center mx-auto">
        @if (!auth()->user()->partner->file)
        <div class="col-12 col-md-6">
            <img src="{{asset('img/test.svg')}}" class="img-fluid mb-3" style="max-width: 200px">
            <p>Selamat Datang di Nganggur.id, <b>{{auth()->user()->name}}</b>!</p>
            <p>Terima Kasih telah melakukan pendaftaran sebagai
                {{auth()->user()->role->title->value .' '.auth()->user()->type->title}}. Untuk melanjutkan,
                silahkan pilih
                tombol <b>"Ujian Sekarang"</b> dibawah ini.</p>
            <a href="{{route('partner.question')}}"
                class="btn btn-primary roundedCorner w-75 text-white font-weight-bold">
                Ujian Sekarang
            </a>
        </div>
        @elseif(auth()->user()->partner->file && !auth()->user()->partner->verified_at &&
        !auth()->user()->partner->rejected_at)
        <div class="col-12 col-md-6">
            <img src="{{asset('img/test.svg')}}" class="img-fluid mb-3" style="max-width: 200px">
            <p>Anda telah mengikuti ujian verifikasi sebagai Mitra Nganggur.id. Selanjutnya, silahkan menunggu Tim
                Nganggur.id untuk memverifikasi jawaban yang telah anda berikan.</p>
        </div>
        @elseif(auth()->user()->partner->verified_at)
        <script type="module">
            window.location = "{{route('home.index')}}";
        </script>
        @elseif(auth()->user()->partner->rejected_at)
        <div class="col-12 col-md-6">
            <img src="{{asset('img/test.svg')}}" class="img-fluid mb-3" style="max-width: 200px">
            <p>Tim Nganggur.id telah memeriksa jawaban ujian anda. Mohon Maaf, anda dinyatakan <b>belum</b>
                dapat
                bergabung
                sebagai Mitra.</p>
        </div>
        @endif
    </div>
</div>
@endsection
