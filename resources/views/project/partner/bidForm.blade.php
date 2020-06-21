@extends('layouts.app',[
'title'=> $bid ? 'Ubah Penawaran' : 'Tambah Penawaran',
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
         <a href="{{route('project.details',['id'=>$project->id])}}">
            <span class="material-icons text-dark" style="font-size:30pt">arrow_back</span>
         </a>
      </div>
      <div class="col-8 pl-0">
         <h4 class="font-weight-bold">{{$bid ? 'Ubah Penawaran' : 'Tambah Penawaran'}}</h4>
         <h6>{{$project->title}}</h6>
      </div>
   </div>

   <div class="row align-items-center justify-content-center my-1">
      <img src="{{$project->subtype->icon}}" class="img-fluid bg-light">
   </div>

   <div class="row align-items-center mt-3">
      <div class="col-12">
         <form action="{{route('project.bid.post',['project_id'=>$project->id])}}" method="POST">
            @csrf
            <div class="form-group row justify-content-center">
               <div class="col-6 pr-1">
                  <label for="duration" class="px-2 font-weight-bold">Durasi Anda</label>
                  <div class="input-group ">
                     <input id="duration" placeholder="Pengerjaan" type="number"
                        class="form-control @error('duration') is-invalid @enderror" name="duration"
                        value="{{ old('duration') }}{{isset($bid->duration) ? $bid->duration : ''}}" min="1"
                        style="border-radius:15px 0 0 15px">
                     <div class="input-group-prepend">
                        <div class="input-group-text  font-weight-bold" style="border-radius:0 15px 15px 0">hari</div>
                     </div>
                     @error('duration')
                     <span class="invalid-feedback px-2" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>

               <div class="col-6 pl-1">
                  <label for="budget" class="px-2 font-weight-bold">Anggaran Anda</label>
                  <div class="input-group">
                     <div class="input-group-prepend">
                        <div class="input-group-text font-weight-bold" style="border-radius:15px 0 0 15px">Rp</div>
                     </div>
                     <input id="budget" placeholder="Jumlah" type="number"
                        class="form-control  @error('budget') is-invalid @enderror" name="budget"
                        value="{{ old('budget') }}{{isset($bid->budget) ? $bid->budget : ''}}"
                        style="border-radius:0 15px 15px 0">
                     @error('budget')
                     <span class="invalid-feedback px-2" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>

            </div>

            <div class="form-group row justify-content-center">
               <div class="col-12">
                  <label for="message" class="px-2 font-weight-bold">Pesan Penawaran</label>
                  <div class="input-group">
                     <textarea id="message"
                        placeholder="contoh : Saya adalah pekerja yang handal dan memiliki pengalaman diatas 5 tahun untuk mengerjakan project ini."
                        name="message" class="form-control roundedCorner @error('message') is-invalid @enderror"
                        rows="5">{{old('message')}}{{isset($bid->message) ? $bid->message : ''}}</textarea>
                     @error('message')
                     <span class="invalid-feedback px-2 " role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>
            </div>

            <button type="submit" class="p-0">
               <nav class="navbar fixed-bottom bg-primary shadow-lg py-3 border-top border-primary ripple">
                  <div class="container">
                     <p class="font-weight-bold text-center text-white h4 w-100">
                        {{$bid ? 'UBAH PENAWARAN' : 'TAMBAH PENAWARAN'}}
                     </p>
                  </div>
               </nav>
            </button>

         </form>

      </div>
   </div>
</div>


</div>



@endsection