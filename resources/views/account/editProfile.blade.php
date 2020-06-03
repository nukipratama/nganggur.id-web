@extends('layouts.app',[
'title'=>'Edit Profil',
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
         <a href="{{route('home')}}">
            <span class="material-icons text-dark" style="font-size:30pt">arrow_back</span>
         </a>
      </div>
      <div class="col-8 pl-0">
         <h2 class="font-weight-bold">Edit Profil</h2>
      </div>
   </div>

   <div class="row justify-content-center align-items-center mt-3 text-center">
      <div class="col-6 col-md-2">
         <img
            src="{{Auth::user()->details->photo ? Auth::user()->details->photo : asset('img/avatar_placeholder.png')}}"
            class="img-fluid rounded-circle shadow">
      </div>
   </div>

   <div class="row align-items-center mt-3">
      <div class="col-12">
         <form action="{{route('project.post')}}" method="POST">
            @csrf

            <div class="form-group row justify-content-center">
               <div class="col-md-8">
                  <label for="photo" class="px-2 font-weight-bold">Ubah Foto Profil</label>
                  <div class="input-group">
                     <input id="photo" type="text"
                        class="form-control roundedCorner @error('photo') is-invalid @enderror" photo="photo"
                        value="{{ old('photo') }}{{Auth::user()->details->photo}}">
                     @error('photo')
                     <span class="invalid-feedback px-2" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>
            </div>

            <div class="form-group row justify-content-center">
               <div class="col-md-8">
                  <label for="name" class="px-2 font-weight-bold">Nama Lengkap</label>
                  <div class="input-group">
                     <input id="name" type="text" class="form-control roundedCorner @error('name') is-invalid @enderror"
                        name="name" value="{{ old('name') }}{{Auth::user()->name}}">
                     @error('name')
                     <span class="invalid-feedback px-2" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>
            </div>

            <div class="form-group row justify-content-center">
               <div class="col-md-8">
                  <label for="email" class="px-2 font-weight-bold">Email</label>
                  <div class="input-group">
                     <input id="email" type="email"
                        class="form-control roundedCorner @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}{{Auth::user()->email}}">
                     @error('email')
                     <span class="invalid-feedback px-2" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>
            </div>

            <div class="form-group row justify-content-center">
               <div class="col-md-2">
                  <label for="gender" class="px-2 font-weight-bold">Jenis Kelamin</label>
                  <div class="input-group">
                     <select class="form-control roundedCorner @error('type') is-invalid @enderror" id="type"
                        name="gender">
                        <option value="">Pilih
                        </option>
                        <option value="male" {{ Auth::user()->details->gender === 'm' ? 'selected' : ''}}>Laki-laki
                        </option>
                        <option value="female" {{ Auth::user()->details->gender === 'f' ? 'selected' : ''}}>Perempuan
                        </option>
                     </select>
                     @error('type')
                     <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>
               <div class="col-md-3">
                  <label for="phone" class="px-2 font-weight-bold">Telepon</label>
                  <div class="input-group">
                     <input id="phone" type="phone"
                        class="form-control roundedCorner @error('phone') is-invalid @enderror" name="phone"
                        value="{{ old('phone') }}{{Auth::user()->details->phone}}">
                     @error('phone')
                     <span class="invalid-feedback px-2" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>
               <div class="col-md-3">
                  <label for="birth" class="px-2 font-weight-bold">Tanggal Lahir</label>
                  <div class="input-group">
                     <input id="birth" type="birth"
                        class="form-control roundedCorner @error('birth') is-invalid @enderror" name="birth"
                        value="{{ old('birth') }}{{Auth::user()->birth}}">
                     @error('birth')
                     <span class="invalid-feedback px-2" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>
            </div>

            <div class="form-group row justify-content-center">
               <div class="col-md-8">
                  <label for="address" class="px-2 font-weight-bold">Alamat</label>
                  <div class="input-group">
                     <input id="address" type="address"
                        class="form-control roundedCorner @error('address') is-invalid @enderror" name="address"
                        value="{{ old('address') }}{{Auth::user()->details->address}}">
                     @error('address')
                     <span class="invalid-feedback px-2" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>
            </div>

            <div class="form-group row justify-content-center">
               <div class="col-md-8">
                  <label for="address" class="px-2 font-weight-bold">Nomor Identitas</label>
                  <div class="input-group">
                     <input id="address" type="address"
                        class="form-control roundedCorner @error('address') is-invalid @enderror" name="address"
                        value="{{ old('address') }}{{Auth::user()->details->address}}">
                     @error('address')
                     <span class="invalid-feedback px-2" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>
            </div>

            <button type="submit" class="p-0 border-0">
               <nav class="navbar fixed-bottom bg-primary shadow-lg py-3 border-top border-primary ripple">
                  <div class="container">
                     <p class="font-weight-bold text-center text-white h4 w-100">SIMPAN PROFIL
                     </p>
                  </div>
               </nav>
            </button>

         </form>

      </div>
   </div>



</div>





@endsection