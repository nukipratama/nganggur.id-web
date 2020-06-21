@extends('layouts.app',[
'title'=>'Pilih Kategori Project',
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
         <a href="{{route('project.create')}}">
            <span class="material-icons text-dark" style="font-size:30pt">arrow_back</span>
         </a>
      </div>
      <div class="col-8 pl-0">
         <h4 class="font-weight-bold">Pilih Kategori Project</h4>
      </div>
      <div class="col-2 text-right">
         <a href="{{route('home')}}">
            <span class="material-icons text-dark" style="font-size:30pt">close</span>
         </a>
      </div>
   </div>
   <div class="row justify-content-center">
      @foreach ($subtype as $item)
      <div class="col-12 m-2">
         <div class="card shadow roundedCorner cardRipple">
            <a href="{{route('project.form',['subtype_id'=>$item->id])}}" class="text-dark">
               <div class="card-body" onclick="$(this).closest('form').submit();">
                  <div class="row align-items-center">
                     <div class="col-3 text-center">
                        <img src="{{$item->icon}}" class="img-fluid rounded shadow">
                     </div>
                     <div class="col-7 text-left p-0 ">
                        <h4 class="font-weight-bold">{{$item->title}}</h4>
                        <p>{{$item->subtitle}}</p>
                     </div>
                     <div class="col-2">
                        <span class="material-icons text-dark" style="font-size:25pt">arrow_forward_ios</span>
                     </div>
                  </div>
               </div>
            </a>
         </div>
      </div>
      @endforeach
   </div>
</div>
@endsection