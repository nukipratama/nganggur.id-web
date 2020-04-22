@extends('layouts.app',[
'title'=>'Project Saya',
'searchbar'=>false,
'navbar'=>Auth::check()
])
@section('content')
<div class="container">

   <div class="row justify-content-center align-items-center">
      <div class="col-6">
         <h1 class="font-weight-bold">Profil</h1>
      </div>
      <div class="col-6 text-right">
         <a href="#" data-toggle="dropdown">
            <span class="material-icons text-dark " style="font-size:25pt">more_vert</span>
         </a>
         <div class="dropdown-menu m-0 roundedCorner shadow border-0">
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
   </div>

   <div class="row justify-content-center align-items-center mt-3">
      <div class="col-4 col-md-2 pr-2">
         <img src="{{$user->details->photo ? $user->details->photo : asset('img/avatar_placeholder.png')}}"
            class="img-fluid rounded-circle shadow">
      </div>
      <div class="col-8 col-md-10 pl-2">
         <h5 class="font-weight-bold">{{$user->name}}</h5>
         <span class="text-break">{{$user->email}}</span>
         <span class="d-block">{{$user->role->title}}
            {{$user->role_id === 2 ? ' - '.$user->type->title : '' }}</span>
      </div>
   </div>

   <div class="row justify-content-center align-items-center mt-3">
      {{$user}}
   </div>
</div>
@endsection