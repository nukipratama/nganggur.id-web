<div class="alert alert-warning rounded-0 shadow fixed-top" role="alert" style="z-index:1100">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="alert-heading font-weight-bold">Selamat Datang, {{Auth::user()->name}}!</h4>
    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <p>Anda belum melakukan verifikasi email, silahkan periksa email anda untuk mendapatkan alamat verifikasi. Jika
            anda tidak mendapatkan email, <button type="submit"
                class="btn p-0 m-0 align-baseline alert-link">{{ __('silahkan klik untuk mengirim ulang.') }}</button>
        </p>
    </form>
    @if (session('resent'))
    <div class="mt-1 alert alert-success" role="alert">
        {{ __('Alamat verifikasi telah terkirim, silahkan periksa email anda.') }}
    </div>
    @endif
</div>