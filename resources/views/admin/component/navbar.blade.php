<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="{{route('admin.index')}}">Administrator @nganggur.id</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    @php
    $menu = ['Pembayaran','Pelanggan','Mitra','Project','Pencairan'];
    @endphp
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            @foreach ($menu as $item)
            <li
                class="nav-item {{Route::currentRouteName() === 'admin.'.strtolower($item) ? 'font-weight-bold active' : ''}}">
                <a class="nav-link" href="{{route('admin.'.strtolower($item))}}">{{$item}}</span></a>
            </li>
            @endforeach
            <li>
                <form action="{{route('logout')}}" method="POST">
                    @csrf
                    <button class="btn btn-secondary" type="submit"><i class="fas fa-sign-out-alt"></i>
                        Keluar</button>
                </form>
            </li>
        </ul>
    </div>
</nav>
