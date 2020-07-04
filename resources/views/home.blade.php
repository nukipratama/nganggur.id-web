@extends('layouts.app',[
'title'=>'Beranda',
'searchbar'=>true,
'navbar'=>true
])
@section('content')
@includeWhen(Auth::check()&&!Auth::user()->hasVerifiedEmail(),'layouts.verify')
<div class="container-fluid mt-5 marginBottom">
    <div class="row  justify-content-center">
        <div class="col-md-12 col-lg-8">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow roundedCorner bg-primary text-white border border-primary">
                        <a href="{{route('account.profile',['user'=>Auth::id()])}}" class="text-white">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-4 col-md-2 ">
                                        <img src="{{$user->details->photo ? $user->details->photo : asset('img/avatar_placeholder.png')}}"
                                            class="img-fluid bg-light rounded-circle shadow">
                                    </div>
                                    <div class="col-8 col-md-10 ">
                                        <h5 class="font-weight-bold mb-0">{{$user->name}}</h5>
                                        <span class="">{{$user->email}}</span>
                                        {!!$user->email_verified_at ?
                                        '<span class="material-icons align-middle">verified_user</span>' :
                                        '<span class="material-icons align-middle">report</span>'!!}
                                        <span class="d-block">{{$user->role->title}}
                                            {{$user->role_id === 2 ? ' '.$user->type->title : '' }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="card-body">
                            <div class="row align-items-center text-center">
                                <div class="col-3">
                                    <h6>Total Project</h6>
                                    <h5 class="font-weight-bold">{{$user->badge['total']}}</h5>
                                </div>
                                <div class="col-3">
                                    <h6>Project Berjalan</h6>
                                    <h5 class="font-weight-bold">{{$user->badge['ongoing']}}</h5>
                                </div>
                                <div class="col-3">
                                    <h6>Project Selesai</h6>
                                    <h5 class="font-weight-bold">{{$user->badge['success']}}</h5>
                                </div>
                                <div class="col-3">
                                    <h6>Project Gagal</h6>
                                    <h5 class="font-weight-bold">{{$user->badge['failed']}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3 justify-content-center">
        <div class="col-md-12 col-lg-8">
            <div class="row align-items-center">
                <div class="col-6 m-0">
                    <p class="font-weight-bold">Project Anda</p>
                </div>
                <div class="col-6 m-0">
                    <a href="{{route('account.projects')}}" class="text-dark text-right font-weight-bold">
                        <p>Lihat Semua <i class="fas fa-angle-right"></i></p>
                    </a>
                </div>
            </div>
            @if ($myProject->isNotEmpty())
            @foreach ($myProject as $my)
            <div class="card shadow roundedCorner cardRipple borderLeft mb-3"
                style="--borderLeft-color:{{$my->subtype->type->color}}">
                <a href="{{route('project.details',['project'=>$my->id])}}" class="text-dark">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2 col-md-1 pr-0">
                                <img src="{{$my->subtype->icon}}" class="img-fluid bg-light  shadow">
                            </div>
                            <div class="col-10 col-md-11">
                                <div class="row">
                                    <div class="col-8">
                                        <h5 class="font-weight-bold p-0 m-0">{{$my->title}}</h5>
                                        <p class="m-0">
                                            {{isset($my->partner->name) ? $my->partner->name : 'Belum Ada Partner'}}
                                        </p>
                                    </div>
                                    <div class="col-4">
                                        <h6 class="text-right">
                                            {{\Carbon\Carbon::parse($my->created_at)->diffForHumans()}}
                                        </h6>
                                    </div>
                                </div>
                                <p>{{$my->subtype->title}}</p>
                            </div>
                        </div>
                        <div class="row align-mys-center text-center">
                            <div class="col-md-3 col-6 ">
                                <span class="material-icons text-primary align-middle">visibility</span>
                                <h6 class="d-inline">{{$my->views}}</h6>
                            </div>
                            <div class=" col-md-3 col-6">
                                <span class="material-icons text-primary align-middle">date_range</span>
                                <h6 class="d-inline">{{$my->duration}} hari</h6>
                            </div>
                            <div class="col-md-3 col-6">
                                <span class="material-icons text-primary align-middle">account_balance_wallet</span>
                                <h6 class="d-inline">@currency($my->budget)</h6>
                            </div>
                            <div class="col-md-3 col-6">
                                <span class="d-block roundedCorner" style="background-color: {{$my->status->color}}">
                                    <small class="text-white font-weight-bold p-1">
                                        {{$my->status->name}}
                                    </small>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
            @else
            <h4 class="mt-2 text-center">Tidak ada project berjalan</h4>
            @endif
        </div>
    </div>

    @if (Auth::user()->role_id === 2)
    <div class="row mt-3 justify-content-center">
        <div class="col-md-12 col-lg-8">
            <div class="row align-items-center">
                <div class="col-6 m-0">
                    <p class="font-weight-bold">Project Terbaru</p>
                </div>
                <div class="col-6 m-0">
                    <a href="{{route('projects')}}" class="text-dark text-right font-weight-bold">
                        <p>Lihat Semua <i class="fas fa-angle-right"></i></p>
                    </a>
                </div>
            </div>
            @if ($recentProject)
            @foreach ($recentProject as $recent)
            <div class="card shadow roundedCorner cardRipple borderLeft mb-3"
                style="--borderLeft-color:{{$recent->subtype->type->color}}">
                <a href="{{route('project.details',['project'=>$recent->id])}}" class="text-dark">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2 col-md-1 pr-0">
                                <img src="{{$recent->user->details->photo ? $recent->user->details->photo : asset('img/avatar_placeholder.png')}}"
                                    class="img-fluid bg-light rounded-circle shadow">
                            </div>
                            <div class="col-10 col-md-11">
                                <div class="row">
                                    <div class="col-8">
                                        <h5 class="font-weight-bold">{{$recent->title}}</h5>
                                        <h5 class="">{{$recent->user->name}}</h5>
                                    </div>
                                    <div class="col-4">
                                        <h6 class="text-right">
                                            {{\Carbon\Carbon::parse($recent->created_at)->diffForHumans()}}
                                        </h6>
                                    </div>
                                </div>
                                <p>{{$recent->subtype->title}}</p>
                            </div>
                        </div>
                        <div class="row align-items-center text-center">
                            <div class="col-md-3 col-6 ">
                                <span class="material-icons text-primary align-middle">visibility</span>
                                <h6 class="d-inline">{{$recent->views}}</h6>
                            </div>
                            <div class=" col-md-3 col-6">
                                <span class="material-icons text-primary align-middle">date_range</span>
                                <h6 class="d-inline">{{$recent->duration}} hari</h6>
                            </div>
                            <div class="col-md-3 col-6">
                                <span class="material-icons text-primary align-middle">account_balance_wallet</span>
                                <h6 class="d-inline">@currency($recent->budget)</h6>
                            </div>
                            <div class="col-md-3 col-6">
                                <span class="d-block roundedCorner"
                                    style="background-color: {{$recent->status->color}}">
                                    <small class="text-white font-weight-bold p-1">
                                        {{$recent->status->name}}
                                    </small>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
            @else
            <h6 class="text-center">Belum ada project</h6>
            @endif
        </div>

    </div>
    @endif

</div>
@endsection
