@extends('layouts.app',[
'title'=>'Pembayaran',
'searchbar'=>false,
'navbar'=>false
])
@section('content')
<style>
   body {
      background: none;
   }
</style>
<div class="container marginBottom">
   <div class="row align-items-center">
      <div class="col-2 pr-0">
         <a href="{{route('project.details',['id'=>$project->id]) }}">
            <span class="material-icons text-dark" style="font-size:30pt">arrow_back</span>
         </a>
      </div>
      <div class="col-8 pl-0">
         <h4 class="font-weight-bold">Pembayaran</h4>
         <h6>{{$project->title}}</h6>
      </div>
   </div>

   <div class="row justify-content-center align-items-center  my-2">
      <div class="col-12">
         <p>Silahkan lakukan pembayaran sesuai nominal tagihan ke rekening berikut :</p>
         <h1 class="text-center font-weight-bold">237 7687 876 873</h1>
         <h6 class="text-center font-weight-bold">Nganggur.id</h6>
      </div>
      <div class="col-6">
         <p class="font-weight-bold">Total Tagihan :</p>
      </div>
      <div class="col-6">
         <a href="">
            <p class="text-right font-weight-bold">Detail Tagihan</p>
         </a>
      </div>
      <div class="col-12 text-center">
         <h1 class="display-4 font-weight-bold" id="invoice">@currency($project->invoice)</h1>
      </div>
   </div>

</div>

<nav class="navbar fixed-bottom bg-primary shadow-lg py-3 border-top border-primary ripple">
   <div class="container">
      <p class="font-weight-bold text-center text-white h4 w-100">BAYAR
      </p>
   </div>
</nav>
<script src="{{asset('js/invoice.js')}}"></script>

@endsection