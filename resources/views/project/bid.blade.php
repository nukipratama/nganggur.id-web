@extends('layouts.app',[
'title'=>'Pilih Mitra',
'searchbar'=>false,
'navbar'=>false
])
@section('content')
<style>
   body {
      background: none;
   }
</style>
<div class="container">
   <div class="row align-items-center">
      <div class="col-2 pr-0">
         <a href="{{route('project.details',['id'=>$bid->project_id])}}">
            <span class="material-icons text-dark" style="font-size:30pt">arrow_back</span>
         </a>
      </div>
      <div class="col-8 pl-0">
         <h4 class="font-weight-bold">Pilih Mitra</h4>
         <h6>{{$bid->user->name}}</h6>
      </div>
      <div class="col-2 text-right">
         <div class="btn-group dropleft">
            <a href="#" data-toggle="dropdown">
               <span class="material-icons text-dark " style="font-size:25pt">more_vert</span>
            </a>
            <div class="dropdown-menu m-0 roundedCorner shadow border-0 ">
               <form action="{{route('logout')}}" method="POST">
                  @csrf
                  <button class="dropdown-item" type="submit"><i class="fas fa-trash"></i>
                     Hapus Penawaran</button>
               </form>
            </div>
         </div>
      </div>
   </div>

   <div class="row my-3 align-items-center">
      <div class="col-12">
         <div class="card border-0 cardRipple roundedCorner">
            <div class="card-body p-2">
               <div class="row">
                  <div class="col-2 col-md-1">
                     <img
                        src="{{ $bid->user->details->photo ? $bid->user->details->photo : asset('img/avatar_placeholder.png')}}"
                        class="img-fluid rounded-circle shadow">
                  </div>
                  <div class="col-10 col-md-11">
                     <div class="row">
                        <div class="col-8">
                           <h5 class="">{{$bid->user->name}}</h5>
                           <h5 class="font-weight-bold">Rp{{$bid->budget}} / {{$bid->duration}} hari</h5>
                        </div>
                        <div class="col-4">
                           <h6 class="text-right">
                              {{\Carbon\Carbon::parse($bid->created_at)->format('d M Y H:m:s')}}
                           </h6>
                        </div>
                     </div>
                  </div>
                  <p class="mt-3 p-3 text-justify show-read-more bg-light">{{$bid->message}}</p>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<form action="{{route('project.bid.pick',['id'=>$bid->id])}}" method="post">
   @csrf
   @method('PUT')
   <button type="submit" class="p-0">
      <nav class="navbar fixed-bottom bg-primary shadow-lg py-3 border-top border-primary ripple">
         <div class="container">
            <p class="font-weight-bold text-center text-white h4 w-100">PILIH SEBAGAI MITRA
            </p>
         </div>
      </nav>
   </button>
</form>

@endsection