@extends('layouts.app',['title'=>'Daftar'])

@section('content')
<div class="container">
    <div class="row h-100 align-items-center">
        <div class="col-md-6 my-1 text-center ">
            <img src="{{asset('img/register.svg')}}" class="img-fluid">
        </div>
        <div class="col-md-6 my-1 ">
            <div class="card py-2 shadow roundedCorner">
                <div class="card-body text-center">
                    <h1>Daftar Sekarang!</h1>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group row justify-content-center">
                            <p class="col-md-8 mb-0">Sudah memiliki akun? <a href="{{route('login')}}">Masuk disini!</a>
                            </p>
                        </div>
                        <div class="form-group row justify-content-center">
                            <p class="col-md-8">Silahkan isi formulir dengan data diri anda
                                untuk
                                bergabung
                                bersama kami
                            </p>
                            <div class="col-md-8">
                                <input id="name" placeholder="&#xf2bb; Nama" type="text"
                                    class="form-control roundedCorner @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" autofocus required autocomplete="name">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            <div class="col-md-8">
                                <input id="email" placeholder="&#xf0e0; E-mail" type="email"
                                    class="form-control roundedCorner @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row justify-content-center">

                            <div class="col-md-8">
                                <input id="password" type="password" placeholder="&#xf084; Kata Sandi"
                                    class="form-control roundedCorner @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">

                            <div class="col-md-8">
                                <input id="password-confirm" placeholder='&#xf084; Ulang Kata Sandi' type="password"
                                    class="form-control roundedCorner" name="password_confirmation" required
                                    autocomplete="new-password">
                            </div>
                        </div>



                        <div class="form-group row justify-content-center mb-0">
                            <div class="col-md-8 my-1">
                                <button type="submit" class="btn btn-primary w-100 roundedCorner">
                                    <i class="fas fa-file-signature"></i> Daftar dengan Formulir
                                </button>
                            </div>

                        </div>

                        <div class="form-group row justify-content-center">
                            <small class="col-md-8">Dengan menekan tombol Daftar, anda telah mengerti dan setuju
                                terhadap syarat dan ketentuan penggunaan layanan nganggur.id</small>
                        </div>

                    </form>
                    <hr>
                    <div class="form-group row justify-content-center">
                        <p class="col-md-8 mb-0">Daftar sebagai Mitra? <a href="{{route('register.partner.form')}}">Klik
                                disini!</a>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection