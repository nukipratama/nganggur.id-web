@extends('layouts.app',[
'title'=>'Home',
'navbar'=>Auth::check() ? true : false
])

@includeWhen(!Auth::check(),'layouts.authbar')

@section('content')
<div class="container-fluid">
    @if (Auth::check())
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h4 class="">Halo, {{Auth::user()->name}}</h4>
        </div>
    </div>

    <div class="row mt-3 justify-content-center">
        <div class="col-md-8">
            <div class="row align-items-center">
                <div class="col-6 m-0">
                    <h5 class="font-weight-bold">Project Anda</h5>
                </div>
                <div class="col-6 m-0">
                    <a href="" class="text-dark text-right font-weight-bold">
                        <p>Lihat Semua <i class="fas fa-angle-right"></i></p>
                    </a>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-12">
                    <div class="card cardCustom roundedCorner border border-dark">
                        <div class="card-body">
                            <div class="row ">
                                <div class="col-2">
                                    <img src="{{asset('img/user.png')}}" class="img-fluid">
                                </div>
                                <div class="col-10">
                                    <div class="row">
                                        <div class="col-6">
                                            <h6 class="">Project Owner</h6>
                                            <h4 class="font-weight-bold">Project Title</h4>
                                        </div>
                                        <div class="col-6">
                                            <h6 class="text-right">Project Category</h6>
                                        </div>
                                    </div>
                                    <p>Project Description Project Description Project Description Project
                                        Description Project Description Project Description Project Description</p>
                                </div>
                            </div>
                            <div class="row mt-3 justify-content-center">
                                <div class="col-md-3 col-6 text-center">
                                    <span class="material-icons text-primary ">status</span>
                                    <h6 class="">Menunggu Bid</h6>
                                </div>
                                <div class="col-md-3 col-6 text-center">
                                    <span class="material-icons text-primary ">views</span>
                                    <h6 class="">526.000</h6>
                                </div>
                                <div class="col-md-3 col-6 text-center">
                                    <span class="material-icons text-primary ">price</span>
                                    <h6 class="">IDR 2.000.000</h6>
                                </div>
                                <div class=" col-md-3 col-6 text-center">
                                    <span class="material-icons text-primary ">duration</span>
                                    <h6 class="">30 days</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

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
            $title = ['test','test','test','test','test'];
            ?>
            @foreach ($title as $item)
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="card cardCustom roundedCorner border border-gray">
                        <div class="card-body">
                            <div class="row ">
                                <div class="col-2">
                                    <img src="{{asset('img/user.png')}}" class="img-fluid">
                                </div>
                                <div class="col-10">
                                    <div class="row">
                                        <div class="col-6">
                                            <h6 class="">Project Owner</h6>
                                            <h4 class="font-weight-bold">Project Title</h4>
                                        </div>
                                        <div class="col-6">
                                            <h6 class="text-right">Project Category</h6>
                                        </div>
                                    </div>
                                    <p>Project Description Project Description Project Description Project
                                        Description Project Description Project Description Project Description</p>
                                </div>
                            </div>
                            <div class="row mt-3 justify-content-center">
                                <div class="col-md-3 col-6 text-center">
                                    <span class="material-icons text-primary ">status</span>
                                    <h6 class="">Menunggu Bid</h6>
                                </div>
                                <div class="col-md-3 col-6 text-center">
                                    <span class="material-icons text-primary ">views</span>
                                    <h6 class="">526.000</h6>
                                </div>
                                <div class="col-md-3 col-6 text-center">
                                    <span class="material-icons text-primary ">price</span>
                                    <h6 class="">IDR 2.000.000</h6>
                                </div>
                                <div class=" col-md-3 col-6 text-center">
                                    <span class="material-icons text-primary ">duration</span>
                                    <h6 class="">30 days</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach


        </div>
    </div>
</div>
@endsection