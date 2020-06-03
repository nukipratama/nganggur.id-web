@extends('layouts.app',[
'title'=>'Project Anda',
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
         <a href="{{route('home')}}">
            <span class="material-icons text-dark" style="font-size:30pt">arrow_back</span>
         </a>
      </div>
      <div class="col-8 pl-0">
         <h2 class="font-weight-bold">Project</h2>
      </div>
   </div>

   @foreach ($project as $status)
   <div class="row mt-3 justify-content-center">
      <div class="col-md-8">
         <div class="row align-items-center">
            <div class="col-6 m-0">
               <p class="font-weight-bold text-secondary">{{$status[0]->status->name}}</p>
            </div>
            <div class="col-6 m-0">
               <a href="" class="text-dark text-right font-weight-bold">
                  <p>Lihat Semua <i class="fas fa-angle-right"></i></p>
               </a>
            </div>
         </div>
         @foreach ($status as $item)
         <div class="card shadow roundedCorner cardRipple mb-3">
            <a href="{{route('project.details',['id'=>$item->id])}}" class="text-dark">
               <div class="card-body">
                  <div class="row">
                     <div class="col-3 col-md-1">
                        <img src="{{$item->subtype->icon}}" class="img-fluid shadow">
                     </div>
                     <div class="col-9 col-md-11">
                        <div class="row">
                           <div class="col-8">
                              <h5 class="font-weight-bold">{{$item->title}}</h5>
                              <p>{{isset($item->partner->name) ? $item->partner->name : 'Belum Ada Partner'}}</p>
                           </div>
                           <div class="col-4">
                              <h6 class="text-right">
                                 {{\Carbon\Carbon::parse($item->created_at)->format('d M Y H:m:s')}}
                              </h6>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row align-items-center text-center mt-3">
                     <div class="col-md-6 col-6">
                        <span class="material-icons text-primary align-middle">account_balance_wallet</span>
                        <h6 class="d-inline">@currency($item->budget)</h6>
                     </div>
                     <div class="col-md-6 col-6">
                        <span class="d-block"><small class="text-white roundedCorner font-weight-bold p-1"
                              style="background-color: {{$item->status->color}}">{{$item->status->name}}</small></span>
                     </div>
                  </div>
               </div>
            </a>
         </div>
         @if ($loop->iteration === 2)
         @break
         @endif
         @endforeach
      </div>
   </div>
   @endforeach




</div>





@endsection