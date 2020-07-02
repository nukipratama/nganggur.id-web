@extends('layouts.app',[
'title'=>$user->name,
'searchbar'=>false,
'navbar'=>Route::current()->parameter('user')->id === Auth::id()
])
@section('content')
<style>


</style>
<div class="container marginBottom">
    <div class="row justify-content-center align-items-center">
        <div class="col-6">
            <h1 class="font-weight-bold">
                Profil</h1>
        </div>
        <div class="col-6 text-right">
            @if (Route::current()->parameter('user')->id === Auth::id())
            <div class="btn-group dropleft dropdown">
                <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <span class="material-icons text-dark " style="font-size:25pt">more_vert</span>
                </a>
                <div class="dropdown-menu m-0 roundedCorner shadow border-0" aria-labelledby="dropdownMenuLink">
                    <a href="{{route('account.edit')}}">
                        <button class="dropdown-item" type="button"><i class="fas fa-pencil-alt"></i> Edit
                            Profil</button>
                    </a>
                    <a href="{{route('account.password')}}">
                        <button class="dropdown-item" type="button"><i class="fas fa-key"></i> Ubah Kata
                            Sandi</button>
                    </a>
                    <hr class="m-0">
                    <form action="{{route('logout')}}" method="POST">
                        @csrf
                        <button class="dropdown-item" type="submit"><i class="fas fa-sign-out-alt"></i>
                            Keluar</button>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>

    <div class="row justify-content-center align-items-center mt-3 text-center">
        <div class="col-4 col-md-2">
            <img src="{{$user->details->photo ? $user->details->photo : asset('img/avatar_placeholder.png')}}"
                class="img-fluid bg-light rounded-circle shadow">
        </div>
    </div>

    <div class="row justify-content-center align-items-center mt-3 text-center">
        <div class="col-12 col-md-12">
            <h5 class="font-weight-bold">{{$user->name}}</h5>
            <span class="text-break">{{$user->email}}</span>
            <span class="d-block">{{$user->role->title}}
                {{$user->role_id === 2 ? ' '.$user->type->title : '' }}{{ ' sejak '.\Carbon\Carbon::parse($user->created_at)->format('d M Y')}}</span>
        </div>
    </div>

    <div class="row my-3 px-3">
        <div class="card-body bg-white shadow-sm roundedCorner">
            <div class="row align-items-center text-center">
                <div class="col-4">
                    <h6 class="font-weight-bold">Total<br>Project</h6>
                    <h6>{{$user->badge['total']}}</h6>
                </div>
                <div class="col-4">
                    <h6 class="font-weight-bold">Project<br>Selesai</h6>
                    <h6>{{$user->badge['success']}}</h6>
                </div>
                <div class="col-4">
                    <h6 class="font-weight-bold">Project<br>Berjalan</h6>
                    <h6>{{$user->badge['ongoing']}}</h6>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection
