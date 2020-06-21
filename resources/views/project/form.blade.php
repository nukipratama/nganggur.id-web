@extends('layouts.app',[
'title'=>isset($project) ? 'Ubah Project' : 'Detail Project',
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
         @if (isset($project->title))
         <a href="{{route('project.details',['id'=>$project->id])}}">
            <span class="material-icons text-dark" style="font-size:30pt">arrow_back</span>
         </a>
         @else
         <a href="{{route('project.subtype',['type_id'=>$subtype->type_id])}}">
            <span class="material-icons text-dark" style="font-size:30pt">arrow_back</span>
         </a>
         @endif
      </div>
      <div class="col-8 pl-0">
         <h4 class="font-weight-bold">{{isset($project) ? 'Ubah Project' : 'Detail Project'}}</h4>
         <h6>{{$subtype->title}}</h6>
      </div>
      <div class="col-2 text-right">
         @if (!isset($project->title))
         <a href="{{route('home')}}">
            <span class="material-icons text-dark" style="font-size:30pt">close</span>
         </a>
         @endif
      </div>
   </div>
   <div class="row align-items-center justify-content-center my-1">
      <img src="{{$subtype->icon}}" class="img-fluid bg-light">
   </div>

   <div class="row align-items-center mt-3">
      <div class="col-12">
         <form action="{{route('project.post')}}" method="POST">
            @csrf
            @if (isset($project->title))
            <input type="hidden" name="id" value="{{$project->id}}">
            @endif
            <input type="hidden" name="subtype_id" value="{{$subtype->id}}">
            <div class="form-group row justify-content-center">
               <div class="col-12">
                  <label for="title" class="px-2 font-weight-bold">Judul Project</label>
                  <div class="input-group">
                     <input id="title" placeholder="contoh : Aplikasi Android CRUD Flutter" type="text"
                        class="form-control roundedCorner @error('title') is-invalid @enderror" name="title"
                        value="{{ old('title') }}{{isset($project->title) ? $project->title : ''}}">
                     @error('title')
                     <span class="invalid-feedback px-2" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>
            </div>

            <div class="form-group row justify-content-center">

               <div class="col-6 pr-1">
                  <label for="duration" class="px-2 font-weight-bold">Durasi Project</label>
                  <div class="input-group ">
                     <input id="duration" placeholder="Pengerjaan" type="number"
                        class="form-control @error('duration') is-invalid @enderror" name="duration"
                        value="{{ old('duration') }}{{isset($project->duration) ? $project->duration : ''}}" min="1"
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
                  <label for="budget" class="px-2 font-weight-bold">Anggaran Project</label>
                  <div class="input-group">
                     <div class="input-group-prepend">
                        <div class="input-group-text font-weight-bold" style="border-radius:15px 0 0 15px">Rp</div>
                     </div>
                     <input id="budget" placeholder="Jumlah" type="number"
                        class="form-control  @error('budget') is-invalid @enderror" name="budget"
                        value="{{ old('budget') }}{{isset($project->budget) ? $project->budget : ''}}"
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
                  <label for="description" class="px-2 font-weight-bold">Deskripsi Project</label>
                  <div class="input-group">
                     <textarea id="description"
                        placeholder="contoh : Pembuatan Aplikasi Android menggunakan framework Flutter. Aplikasi yang dibuat diharapkan dapat berjalan pada kedua platform, yaitu Android dan iOS."
                        name="description" class="form-control roundedCorner @error('description') is-invalid @enderror"
                        rows="5">{{old('description')}}{{isset($project->description) ? $project->description : ''}}</textarea>
                     @error('description')
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
                        {{isset($project) ? 'UBAH PROJECT' : 'BUAT PROJECT'}}
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