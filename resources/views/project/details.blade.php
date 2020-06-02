@extends('layouts.app',[
'title'=>$project->title,
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
         <a href="{{route('projects')}}">
            <span class="material-icons text-dark" style="font-size:30pt">arrow_back</span>
         </a>
      </div>
      <div class="col-8 pl-0">
         <h4 class="font-weight-bold">Detail Project</h4>
         <h6>{{$project->user->name}}</h6>
      </div>
      @if ($project->user_id===Auth::id())
      <div class="col-2 text-right">
         <div class="btn-group dropleft">
            <a href="#" data-toggle="dropdown">
               <span class="material-icons text-dark " style="font-size:25pt">more_vert</span>
            </a>
            <div class="dropdown-menu m-0 roundedCorner shadow border-0 ">
               <a href="{{route('account.edit')}}">
                  <button class="dropdown-item" type="button"><i class="fas fa-pencil-alt"></i> Edit
                     Project</button>
               </a>
               <form action="{{route('logout')}}" method="POST">
                  @csrf
                  <button class="dropdown-item" type="submit"><i class="fas fa-trash"></i>
                     Hapus Project</button>
               </form>
            </div>
         </div>
      </div>
      @endif
   </div>

   <div class="row align-items-center justify-content-center my-1">
      <div class="col-12 text-center my-1">
         <img src="{{$project->subtype->icon}}" class="img-fluid">
      </div>
      <div class="col-5 text-center my-1">
         <span class="text-break">
            Dibuat {{\Carbon\Carbon::parse($project->created_at)->format('d M Y')}}
         </span>
         <span class="d-block "><small
               class="bg-primary text-white roundedCorner font-weight-bold p-1">{{$project->status->name}}</small></span>
         <h5 class="d-block font-weight-bold my-2">Rp{{$project->budget}}</h5>
      </div>
   </div>

   <div class="row my-1">
      <div class="card-body">
         <div class="row align-items-center text-center">
            <div class="col-4">
               <h6 class="font-weight-bold">Kategori</h6>
            </div>
            <div class="col-4">
               <h6 class="font-weight-bold">Dilihat</h6>
            </div>
            <div class="col-4">
               <h6 class="font-weight-bold">Penawaran</h6>
            </div>
            <div class="col-4">
               <h6>{{$project->subtype->title}}</h6>
            </div>
            <div class="col-4">
               <h6>{{$project->views}}</h6>
            </div>
            <div class="col-4">
               <h6>{{count($project->bids)}}</h6>
            </div>
         </div>
      </div>
   </div>

   <div class="row my-1">
      <div class="col-12  my-1">
         <h2 class="font-weight-bold">Deskripsi</h2>
      </div>
      <div class="col-12 my-1">
         <p class="lead font-weight-bold">{{$project->title}}</p>
         <p class="lead text-justify show-read-more ">{{$project->description}}</p>
      </div>
   </div>
</div>

@includeWhen($project->status_id===0, 'project.status.bids', ['bid' => $project->bids])
@if (Auth::id()===$project->user_id)
@includeWhen($project->status_id===1, 'project.status.payment', ['project' => $project])
@endif

@if ($project->canBid)
<form action="{{route('project.bid.form',['project_id'=>$project->id])}}">
   @csrf
   <button type="submit" class="p-0">
      <nav class="navbar fixed-bottom bg-primary shadow-lg py-3 border-top border-primary ripple">
         <div class="container">
            <p class="font-weight-bold text-center text-white h4 w-100">AJUKAN PENAWARAN
            </p>
         </div>
      </nav>
   </button>
</form>
@endif
@if ($project->canUpdate)
<form action="{{route('project.bid.form',['project_id'=>$project->id])}}">
   @csrf
   <button type="submit" class="p-0">
      <nav class="navbar fixed-bottom bg-primary shadow-lg py-3 border-top border-primary ripple">
         <div class="container">
            <p class="font-weight-bold text-center text-white h4 w-100">UBAH PENAWARAN
            </p>
         </div>
      </nav>
   </button>
</form>
@endif


<script src="{{asset('js/readmore.js')}}"></script>

@endsection