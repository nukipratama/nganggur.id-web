@extends('layouts.app',[
'title'=>'Project Saya',
'searchbar'=>false,
'navbar'=>Auth::check()
])
@section('content')
<div class="container marginBottom">

   <div class="row justify-content-center align-items-center">
      <div class="col-6">
         <h1 class="font-weight-bold">Profil</h1>
      </div>
      <div class="col-6 text-right">
         <div class="btn-group dropleft">
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
   </div>

   <div class="row justify-content-center align-items-center mt-3 text-center">
      <div class="col-6 col-md-2">
         <img src="{{$user->details->photo ? $user->details->photo : asset('img/avatar_placeholder.png')}}"
            class="img-fluid rounded-circle shadow">
      </div>
   </div>

   <div class="row justify-content-center align-items-center mt-3 text-center">
      <div class="col-12 col-md-12">
         <h5 class="font-weight-bold">{{$user->name}}</h5>
         <span class="text-break">{{$user->email}}</span>
         <span class="d-block">{{$user->role->title}}
            {{$user->role_id === 2 ? ' - '.$user->type->title : '' }}</span>
      </div>
   </div>


   <div class="row justify-content-center my-3">
      <div class="col-12">
         <h5 class="font-weight-bold">Project Terbaru</h5>
      </div>
      <div class="col-md-12 ">
         @foreach ($projects as $item)
         <div class="card shadow roundedCorner cardRipple mb-3">
            <a href="{{route('project.details',['id'=>$item->id])}}" class="text-dark">
               <div class="card-body">
                  <div class="row">
                     <div class="col-2 col-md-1">
                        <img
                           src="{{$item->user->details->photo ? $item->user->details->photo : asset('img/avatar_placeholder.png')}}"
                           class="img-fluid rounded-circle shadow">
                     </div>
                     <div class="col-10 col-md-11">
                        <div class="row">
                           <div class="col-6">
                              <h5 class="">{{$item->user->name}}</h5>
                           </div>
                           <div class="col-6">
                              <h6 class="text-right">{{$item->created_at}}</h6>
                           </div>
                        </div>
                        <h5 class="font-weight-bold">{{$item->title}}</h5>
                        <p>{{$item->subtype->title}}</p>
                     </div>
                  </div>
                  <div class="row mt-3 align-items-center text-center">
                     <div class="col-md-3 col-6 ">
                        <span class="material-icons text-primary align-middle">visibility</span>
                        <h6 class="d-inline">{{$item->views}}</h6>
                     </div>
                     <div class=" col-md-3 col-6">
                        <span class="material-icons text-primary align-middle">date_range</span>
                        <h6 class="d-inline">{{$item->duration}} hari</h6>
                     </div>
                     <div class="col-md-3 col-6">
                        <span class="material-icons text-primary align-middle">account_balance_wallet</span>
                        <h6 class="d-inline">Rp {{$item->budget}}</h6>
                     </div>
                     <div class="col-md-3 col-6">
                        <span class="material-icons text-primary align-middle">assignment</span>
                        <h6 class="d-inline">{{$item->status->name}}</h6>
                     </div>
                  </div>
               </div>
            </a>
         </div>
         @endforeach
         <div class="row justify-content-center">
            {{ $projects->links() }}
         </div>
      </div>
   </div>
</div>
@endsection