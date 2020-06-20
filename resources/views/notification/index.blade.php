@extends('layouts.app',[
'title'=>'Notifikasi',
'searchbar'=>false,
'navbar'=>true
])
@section('content')
<style>
   body {
      background: none;
   }
</style>
<div class="container marginBottom">
   <div class="row justify-content-center align-items-center">
      <div class="col-12">
         <h1 class="font-weight-bold">
            Notifikasi</h1>
      </div>
   </div>
   <div class="row justify-content-center align-items-center my-3 ">
      <div class="col-12">
         <div id="items">
            @foreach ($notification as $item)
            <a href="{{$item->target}}" class="text-dark ">
               <div class="row justify-content-center align-items-center cardRipple rounded">
                  <div class="col-3">
                     <img src="{{$item->icon}}" class="img-fluid rounded mx-auto d-block">
                  </div>
                  <div class="col-9 pl-0">
                     <p class="pl-1 text-secondary float-right">
                        {{\Carbon\Carbon::parse($item->created_at)->format('d/m')}}
                     </p>
                     <p class="pl-1 text-secondary float-right">
                        {{\Carbon\Carbon::parse($item->created_at)->format('d/m')}}
                     </p>
                     <p class="font-weight-bold my-0">{{$item->title}}</p>
                     <p class="text-secondary my-0">{{$item->description}}</p>
                  </div>
               </div>
            </a>
            <hr class="bg-light">
            @endforeach
         </div>
      </div>
   </div>

   <script>
      function request(){
         $.ajax({
         type: 'GET',
         url: '{{route("notification.unread")}}',
         dataType: 'json',
         success: function (data) {
            data.forEach(element => {
               var content =`<a href="`+element['target']+`" class="text-dark ">
               <div class="row justify-content-center align-items-center cardRipple rounded">
               <div class="col-3">
                  <img src="`+element['icon']+`" class="img-fluid rounded mx-auto d-block">
               </div>
               <div class="col-9 pl-0 pr-1">
                  <p class="pl-1 text-secondary float-right">{{\Carbon\Carbon::parse(`+element['created_at']+`)->format('d/m')}}</p>
                  <p class="font-weight-bold my-0">`+element['title']+`</p>
                  <p class="text-secondary my-0">`+element['description']+`</p>
               </div>
            </div>
            </a>
            <hr class="bg-light">`;  
            $(content).prependTo('#items');     
            });
         },error:function(){ 
            console.log(data);
         }
         });
      } 
      setInterval(request, 10000);
   </script>

   @endsection