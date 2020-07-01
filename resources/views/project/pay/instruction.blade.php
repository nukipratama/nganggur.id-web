@extends('layouts.app',[
'title'=>'Pembayaran',
'searchbar'=>false,
'navbar'=>false
])
@section('content')
<style>
    body {
        background: none;
    }

</style>
<div class="container marginBottom">
    <div class="row align-items-center">
        <div class="col-2 pr-0">
            <a href="{{route('project.details',['project'=>$project->id]) }}">
                <span class="material-icons text-dark" style="font-size:2rem">arrow_back</span>
            </a>
        </div>
        <div class="col-8 pl-0">
            <h4 class="font-weight-bold">Pembayaran</h4>
            <h6>{{$project->title}}</h6>
        </div>
    </div>

    <div class="row justify-content-center align-items-center  my-2">
        <div class="col-12 text-center">
            <p>Silahkan lakukan pembayaran sesuai nominal tagihan ke rekening berikut :</p>
            <h1 class="font-weight-bold">237 7687 876 873</h1>
            <h6 class="font-weight-bold">Nganggur.id</h6>
        </div>
        <div class="col-6">
            <p class="font-weight-bold">Total Tagihan :</p>
        </div>
        <div class="col-6">
            <a href="">
                <p class="text-right font-weight-bold">Detail Tagihan</p>
            </a>
        </div>
        <div class="col-12 text-center">
            <h1 class="display-4 font-weight-bold" id="invoice">@currency($project->invoice)</h1>
        </div>
    </div>

    <div class="row justify-content-center align-items-center  my-2">
        <div class="col-12">
            <h5 class="font-weight-bold">Langkah Pembayaran</h5>
        </div>
        <div class="col-12">
            <div class="card roundedCorner bg-light text-secondary">
                <h5 class="mb-0 p-3 font-weight-bold">Menggunakan ATM</h5>
                <ol>
                    <li>Masukkan Kartu ATM</li>
                    <li>Masukkan PIN</li>
                    <li>Pilih "Transfer"</li>
                    <li>Pilih "Ke Rekening Mandiri"</li>
                    <li>Masukkan No Rek Tujuan</li>
                    <li>Masukkan jumlah pembayaran sesuai dengan yang ditagihkan dalam transaksi (nilai harus sesuai,
                        tidak
                        lebih dan tidak kurang)</li>
                    <li>Kosongkan nomor referensi transfer lalu tekan "Benar"</li>
                    <li>Muncul info konfirmasi transfer, jika sesuai silahkan tekan "Ya"</li>
                    <li>Selesai</li>
                </ol>
            </div>
        </div>
    </div>




</div>
<form action="{{route('project.pay',['project'=>$project->id])}}">
    <input type="hidden" name="payment_method" value="{{$payment_method}}">
    <button type="submit" class="p-0">
        <nav class="navbar fixed-bottom bg-primary shadow-lg py-3 border-top border-primary ripple">
            <div class="container">
                <p class="font-weight-bold text-center text-white h4 w-100">BAYAR
                </p>
            </div>
        </nav>
    </button>
</form>
@if ($project->user_id === Auth::id())
<script src="{{asset('js/invoice.js')}}"></script>
@endif
@endsection
