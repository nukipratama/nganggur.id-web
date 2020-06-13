@extends('layouts.app',[
'title'=>'Daftar Mitra',
'searchbar'=>false,
'navbar'=>false
])
@section('content')
<div class="container">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-12 col-md-8 col-lg-6 my-1 text-center ">
            <img src="{{asset('img/partner.svg')}}" class="img-fluid">
        </div>
        <div class="col-12 col-md-8 col-lg-6 my-1 ">
            <div class="card py-2 shadow roundedCorner">
                <div class="card-body text-center">
                    <h1>Daftar sebagai Mitra!</h1>
                    <form method="POST" action="{{ route('register.partner.create') }}">
                        @csrf
                        <div class="form-group row justify-content-center">
                            <p class="col-md-8 mb-0">Sudah memiliki akun? <a href="{{route('login')}}">Masuk disini!</a>
                            </p>
                        </div>
                        <div class="form-group row justify-content-center">
                            <p class="col-md-8">Silahkan isi formulir dengan data diri anda
                                untuk menjadi mitra nganggur.id
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
                        <div class="form-group row justify-content-center">
                            <div class="col-md-8">
                                <select class="form-control roundedCorner @error('type') is-invalid @enderror" id="type"
                                    name="type">
                                    <option value="">Pilih Jenis Pekerjaan
                                    </option>
                                    @foreach (\App\Type::all() as $item)
                                    <option value="{{$item->id}}">{{$item->title}}</option>
                                    @endforeach
                                </select>
                                @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center mb-0">
                            <div class="col-md-8 my-1">
                                <button type="submit" class="btn btn-primary w-100 roundedCorner">
                                    <i class="fas fa-file-signature"></i> Daftar dengan Formulir
                                </button>
                            </div>
                        </div>


                    </form>


                    <div class="form-group row justify-content-center">
                        <small class="col-md-8">Dengan menekan tombol Daftar, anda telah mengerti dan setuju
                            terhadap syarat dan ketentuan penggunaan layanan nganggur.id</small>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection