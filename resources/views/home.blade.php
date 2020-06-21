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
                        <a href="{{route('account.profile',['id'=>Auth::id()])}}" class="text-white">
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
            @if ($myProject)
            <div class="card shadow roundedCorner cardRipple">
                <a href="{{route('project.details',['id'=>$myProject->id])}}" class="text-dark">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2 col-md-1 pr-0">
                                <img src="{{$myProject->subtype->icon}}" class="img-fluid bg-light  shadow">
                            </div>
                            <div class="col-10 col-md-11">
                                <div class="row">
                                    <div class="col-8">
                                        <h5 class="font-weight-bold p-0 m-0">{{$myProject->title}}</h5>
                                        <p class="m-0">
                                            {{isset($item->partner->name) ? $item->partner->name : 'Belum Ada Partner'}}
                                        </p>
                                    </div>
                                    <div class="col-4">
                                        <h6 class="text-right">
                                            {{\Carbon\Carbon::parse($myProject->created_at)->format('d M Y H:m:s')}}
                                        </h6>
                                    </div>
                                </div>
                                <p>{{$myProject->subtype->title}}</p>
                            </div>
                        </div>
                        <div class="row align-items-center text-center">
                            <div class="col-md-3 col-6 ">
                                <span class="material-icons text-primary align-middle">visibility</span>
                                <h6 class="d-inline">{{$myProject->views}}</h6>
                            </div>
                            <div class=" col-md-3 col-6">
                                <span class="material-icons text-primary align-middle">date_range</span>
                                <h6 class="d-inline">{{$myProject->duration}} hari</h6>
                            </div>
                            <div class="col-md-3 col-6">
                                <span class="material-icons text-primary align-middle">account_balance_wallet</span>
                                <h6 class="d-inline">@currency($myProject->budget)</h6>
                            </div>
                            <div class="col-md-3 col-6">
                                <span class="d-block roundedCorner"
                                    style="background-color: {{$myProject->status->color}}">
                                    <small class="text-white font-weight-bold p-1">
                                        {{$myProject->status->name}}
                                    </small>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @else
            <h6 class="text-center">Anda belum memulai project</h6>
            @endif

        </div>
    </div>

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
            <div class="card shadow roundedCorner cardRipple">
                <a href="{{route('project.details',['id'=>$recentProject->id])}}" class="text-dark">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2 col-md-1 pr-0">
                                <img src="{{$recentProject->user->details->photo ? $recentProject->user->details->photo : asset('img/avatar_placeholder.png')}}"
                                    class="img-fluid bg-light rounded-circle shadow">
                            </div>
                            <div class="col-10 col-md-11">
                                <div class="row">
                                    <div class="col-8">
                                        <h5 class="">{{$recentProject->user->name}}</h5>
                                        <h5 class="font-weight-bold">{{$recentProject->title}}</h5>
                                    </div>
                                    <div class="col-4">
                                        <h6 class="text-right">
                                            {{\Carbon\Carbon::parse($recentProject->created_at)->format('d M Y H:m:s')}}
                                        </h6>
                                    </div>
                                </div>
                                <p>{{$recentProject->subtype->title}}</p>
                            </div>
                        </div>
                        <div class="row align-items-center text-center">
                            <div class="col-md-3 col-6 ">
                                <span class="material-icons text-primary align-middle">visibility</span>
                                <h6 class="d-inline">{{$recentProject->views}}</h6>
                            </div>
                            <div class=" col-md-3 col-6">
                                <span class="material-icons text-primary align-middle">date_range</span>
                                <h6 class="d-inline">{{$recentProject->duration}} hari</h6>
                            </div>
                            <div class="col-md-3 col-6">
                                <span class="material-icons text-primary align-middle">account_balance_wallet</span>
                                <h6 class="d-inline">@currency($recentProject->budget)</h6>
                            </div>
                            <div class="col-md-3 col-6">
                                <span class="d-block roundedCorner"
                                    style="background-color: {{$recentProject->status->color}}">
                                    <small class="text-white font-weight-bold p-1">
                                        {{$recentProject->status->name}}
                                    </small>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @else
            <h6 class="text-center">Belum ada project</h6>
            @endif
        </div>

    </div>
</div>
@endsection