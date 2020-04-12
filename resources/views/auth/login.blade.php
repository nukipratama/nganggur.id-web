@extends('layouts.app',['title'=>'Masuk'])

@section('content')
<div class="container">
    <div class="row h-100  align-items-center">
        <div class="col-md-6 my-1 text-center ">
            <img src="{{asset('img/login.svg')}}" class="img-fluid">
        </div>
        <div class="col-md-6 my-1 ">
            <div class="card py-2 cardCustom roundedCorner">
                <div class="card-body text-center">
                    <h1>Masuk Sekarang!</h1>


                    <div class="form-group row justify-content-center">
                        <p class="col-md-8 mb-0">Belum memiliki akun? <a href="{{route('register')}}">Daftar disini!</a>
                        </p>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row justify-content-center">
                            <p class="col-md-8">Silahkan isi e-mail dan kata sandi dibawah untuk melanjutkan
                            </p>
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
                            <div class="col-md-4 my-1">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Ingat Saya') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4 my-1">
                                @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">
                                    {{ __('Lupa Kata Sandi?') }}
                                </a>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row justify-content-center mb-0">
                            <div class="col-md-8 my-1">
                                <button type="submit" class="btn btn-primary w-100 roundedCorner">
                                    <i class="fas fa-sign-in-alt"></i> Masuk dengan E-mail
                                </button>
                            </div>
                        </div>

                    </form>
                    <div class="separator my-2"> atau </div>

                    <div class="form-group row justify-content-center">
                        <div class="col-md-8 my-1">

                            <a href="{{ route('login.provider', 'google') }}"
                                class="btn btn-danger w-100 roundedCorner">
                                <i class="fab fa-google"></i> Masuk dengan Google</a>
                        </div>
                        <div class="col-md-8 my-1">
                            <button type="submit" class="btn btn-primary w-100 roundedCorner">
                                <i class="fab fa-facebook"></i> Masuk dengan Facebook</button>
                        </div>
                        <div class="col-md-8 my-1">
                            <button type="submit" class="btn btn-dark w-100 roundedCorner">
                                <i class="fab fa-github"></i> Masuk dengan Github</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection