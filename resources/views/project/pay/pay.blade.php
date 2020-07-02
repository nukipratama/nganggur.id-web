@extends('layouts.app',[
'title'=>'Pembayaran',
'searchbar'=>false,
'navbar'=>false
])
@section('content')
<style>
    

</style>
<div class="container marginBottom">
    <div class="row align-items-center">
        <div class="col-2 pr-0">
            <form action="{{route('project.pay.instruction',['project'=>$project->id]) }}" id="back">
                <input type="hidden" name="payment_method" value="{{$payment_method}}">
                <div onclick="$('#back').submit()" style="cursor: pointer">
                    <span class="material-icons text-dark" style="font-size:2rem">arrow_back</span>
                </div>
            </form>
        </div>
        <div class="col-8 pl-0">
            <h4 class="font-weight-bold">Unggah Bukti Pembayaran</h4>
            <h6>{{$project->title}}</h6>
        </div>
    </div>

    <div class="row justify-content-center align-items-center  my-3">
        <div class="col-12 text-center">
            <img src="{{asset('img/bank/'.$payment_method.'.png')}}" class="img-fluid bg-light roundedCorner">
            <h4 class="font-weight-bold m-2">Transfer Bank Mandiri - Nganggur.id</h4>
        </div>
    </div>

    <div class="row justify-content-center align-items-center  my-3">
        <div class="col-12 text-center">
            <p class="">Silahkan Foto / Screenshot bukti pembayaran anda untuk mempercepat proses
                verifikasi pembayaran</p>
        </div>
        <div class="col-12">
            <form action="{{route('project.pay',['project'=>$project->id])}}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="payment_method" value="{{$payment_method}}">
                <div class="form-group row justify-content-center">
                    <div class="col-md-8">
                        <label for="receipt" class="px-2 font-weight-bold">Bukti Pembayaran</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text  font-weight-bold" style="border-radius:15px 0 0 15px">
                                    PILIH
                                </div>
                            </div>
                            <input id="receipt" type="file" class="form-control @error('receipt') is-invalid @enderror"
                                name="receipt">
                            @error('receipt')
                            <span class="invalid-feedback px-2" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="border-0 p-0">
                    <nav class="navbar fixed-bottom bg-primary shadow-lg py-3 border-top border-primary ripple">
                        <div class="container">
                            <p class="font-weight-bold text-center text-white h4 w-100">UNGGAH BUKTI BAYAR</p>
                        </div>
                    </nav>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
