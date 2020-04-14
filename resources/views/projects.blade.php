@extends('layouts.app',[
'title'=>'Projects',
'navbar'=>Auth::check() ? true : false
])
@section('content')
@include('layouts.searchbar')
@includeWhen(!Auth::check(),'layouts.authbar')
<div class="container-fluid">
    <div class="row mt-3 justify-content-center">
        <div class="col-md-8">
            <div class="row align-items-center">
                <div class="col-6 m-0">
                    <h5 class="font-weight-bold">Project Terbaru</h5>
                </div>
                <div class="col-6 m-0">
                    <a href="" class="text-dark text-right font-weight-bold">
                        <p>Lihat Semua <i class="fas fa-angle-right"></i></p>
                    </a>
                </div>
            </div>
            <?php
            $test = ['test','test','test','test','test','test'];
        ?>
            @foreach ($test as $item)
            <div class="mb-3 card shadow roundedCorner cardRipple">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-2 col-md-1">
                            <img src="{{asset('img/avatar_placeholder.png')}}" class="img-fluid rounded-circle shadow">
                        </div>
                        <div class="col-10 col-md-11">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="">Project Owner</h5>
                                    <h4 class="font-weight-bold">Project Title</h4>
                                </div>
                                <div class="col-6">
                                    <h6 class="text-right">Project Date</h6>
                                </div>
                            </div>
                            <p>Project Category</p>
                        </div>
                    </div>
                    <div class="row mt-3 align-items-center text-center">
                        <div class="col-md-3 col-6 ">
                            <span class="material-icons text-primary align-middle">visibility</span>
                            <h6 class="d-inline">526.000</h6>
                        </div>
                        <div class=" col-md-3 col-6">
                            <span class="material-icons text-primary align-middle">date_range</span>
                            <h6 class="d-inline">30 days</h6>
                        </div>
                        <div class="col-md-3 col-6">
                            <span class="material-icons text-primary align-middle">account_balance_wallet</span>
                            <h6 class="d-inline">IDR 2.000.000</h6>
                        </div>
                        <div class="col-md-3 col-6">
                            <span class="material-icons text-primary align-middle">assignment</span>
                            <h6 class="d-inline">Menunggu Bid</h6>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection