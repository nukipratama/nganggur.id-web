@extends('layouts.app',[
'title'=>'Ubah Kata Sandi',
'searchbar'=>false,
'navbar'=>false
])
@section('content')
<style>
    

</style>
<div class="container marginBottom">
    <div class="row align-items-center">
        <div class="col-2 pr-0">
            <a href="{{route('account.profile',['user'=>Auth::id()])}}">
                <span class="material-icons text-dark" style="font-size:2rem">arrow_back</span>
            </a>
        </div>
        <div class="col-8 pl-0">
            <h2 class="font-weight-bold">Ubah Kata Sandi</h2>
        </div>
    </div>

    <div class="row justify-content-center align-items-center mt-3 text-center">
        <div class="col-6 col-md-2">
            <img src="{{asset('img/password.svg')}}" class="img-fluid bg-light ">
        </div>
    </div>

    <div class="row align-items-center mt-3">
        <div class="col-12">
            <form action="{{route('account.password.put')}}" method="POST" id="password">
                @csrf
                @method('PUT')

                <div class="form-group row justify-content-center">
                    <div class="col-md-8">
                        <label for="name" class="px-2 font-weight-bold">Kata Sandi Lama</label>
                        <div class="input-group">
                            <input id="old_password" type="password"
                                class="form-control roundedCorner @error('old_password') is-invalid @enderror"
                                name="old_password" required>
                            @error('old_password')
                            <span class="invalid-feedback px-2" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group row justify-content-center">
                    <div class="col-md-8">
                        <label for="password" class="px-2 font-weight-bold">Kata Sandi Baru</label>
                        <div class="input-group">
                            <input id="password" type="password"
                                class="form-control roundedCorner @error('password') is-invalid @enderror"
                                name="password" required>
                            @error('password')
                            <span class="invalid-feedback px-2" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group row justify-content-center">
                    <div class="col-md-8">
                        <label for="password_confirmation" class="px-2 font-weight-bold">Ulangi Kata Sandi Baru</label>
                        <div class="input-group">
                            <input id="password_confirmation" type="password"
                                class="form-control roundedCorner @error('password_confirmation') is-invalid @enderror"
                                name="password_confirmation" required>
                            @error('password_confirmation')
                            <span class="invalid-feedback px-2" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>


                <button type="submit" class="p-0 border-0"
                    onclick="swal('Apakah anda yakin untuk mengubah password ?','#password',event)">>
                    <nav class="navbar fixed-bottom bg-primary shadow-lg py-3 border-top border-primary ripple">
                        <div class="container">
                            <p class="font-weight-bold text-center text-white h4 w-100">SIMPAN PROFIL
                            </p>
                        </div>
                    </nav>
                </button>

            </form>

        </div>
    </div>



</div>

@endsection
