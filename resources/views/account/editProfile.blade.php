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
         <a href="{{route('account')}}">
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
         <form action="{{route('account.edit.put')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group row justify-content-center">
               <div class="col-md-8">
                  <label for="photo" class="px-2 font-weight-bold">Ubah Foto Profil</label>
                  <div class="input-group">
                     <div class="input-group-prepend">
                        <div class="input-group-text  font-weight-bold" style="border-radius:15px 0 0 15px">BROWSE
                        </div>
                     </div>
                     <input id="photo" type="file" class="form-control @error('photo') is-invalid @enderror"
                        name="photo">
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
                        name="name" value="{{ old('name') ? old('name') : Auth::user()->name}}" required>
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
                        value="{{ old('email') ? old('email') : Auth::user()->email}}" required>
                     @error('email')
                     <span class="invalid-feedback px-2" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>
            </div>

            <div class="form-group row justify-content-center">
               <div class="col-md-2 mb-3">
                  <label for="gender" class="px-2 font-weight-bold">Jenis Kelamin</label>
                  <div class="input-group">
                     <select class="form-control roundedCorner @error('type') is-invalid @enderror" id="type"
                        name="gender">
                        <option value="">Pilih
                        </option>
                        <option value="m" {{ Auth::user()->details->gender === 'm' ? 'selected' : ''}}>Laki-laki
                        </option>
                        <option value="f" {{ Auth::user()->details->gender === 'f' ? 'selected' : ''}}>Perempuan
                        </option>
                     </select>
                     @error('type')
                     <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label for="phone" class="px-2 font-weight-bold">Telepon</label>
                  <div class="input-group">
                     <input id="phone" type="phone"
                        class="form-control roundedCorner @error('phone') is-invalid @enderror" name="phone"
                        value="{{ old('phone') ? old('phone') : Auth::user()->details->phone}}">
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
                     <input id="birth" type="date"
                        class="form-control roundedCorner @error('birth') is-invalid @enderror" name="birth"
                        value="{{ old('birth') ? old('birth') : Auth::user()->details->birth}}">
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
                        value="{{ old('address') ? old('address') : Auth::user()->details->address}}">
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
                  <label for="identity" class="px-2 font-weight-bold">Nomor Identitas</label>
                  <div class="input-group">
                     <input id="identity" type="identity"
                        class="form-control roundedCorner @error('identity') is-invalid @enderror" name="identity"
                        value="{{ old('identity') ? old('identity') : Auth::user()->details->identity}}">
                     @error('identity')
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