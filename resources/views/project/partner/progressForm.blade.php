@extends('layouts.app',[
'title'=> 'Unggah Pengerjaan',
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
            <a href="{{route('project.details',['project'=>$project->id])}}">
                <span class="material-icons text-dark" style="font-size:30pt">arrow_back</span>
            </a>
        </div>
        <div class="col-8 pl-0">
            <h4 class="font-weight-bold">Unggah Pengerjaan</h4>
            <h6>{{$project->title}}</h6>
        </div>
    </div>

    <div class="row align-items-center justify-content-center my-1">
        <img src="{{$project->subtype->icon}}" class="img-fluid bg-light">
    </div>

    <div class="row align-items-center mt-3">
        <div class="col-12">
            <form action="{{route('project.progress.post',['project'=>$project->id])}}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group row justify-content-center">
                    <div class="col-12 ">
                        <label for="title" class="px-2 font-weight-bold">Judul</label>
                        <div class="input-group ">
                            <input id="title" placeholder="contoh : Membuat Tampilan Halaman Utama" type="text"
                                class="form-control @error('title') is-invalid @enderror" name="title"
                                style="border-radius:15px 0 0 15px">
                            @error('title')
                            <span class="invalid-feedback px-2" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="form-group row justify-content-center">
                    <div class="col-12">
                        <label for="description" class="px-2 font-weight-bold">Deskripsi</label>
                        <div class="input-group">
                            <textarea id="description"
                                placeholder="contoh : Tampilan Halaman Utama dibuat berdasarkan ketentuan dari Pemilik Project."
                                name="description"
                                class="form-control roundedCorner @error('description') is-invalid @enderror"
                                rows="5">{{old('description')}}{{isset($bid->description) ? $bid->description : ''}}</textarea>
                            @error('description')
                            <span class="invalid-feedback px-2 " role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="field_wrapper">
                    <label for="attachment" class="px-2 font-weight-bold">Lampiran</label>
                    <a href="javascript:void(0);" class="add_button text-dark">
                        <div class="row align-items-center float-right pr-3 ">
                            <span class="material-icons " style="font-size: 20pt">post_add</span>
                            <span class=" font-weight-bold">Tambah Lampiran</span>
                        </div>
                    </a>
                    <div class="form-group row justify-content-center">
                        <div class="col-12">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text  font-weight-bold" style="border-radius:15px 0 0 15px">
                                        PILIH
                                    </div>
                                </div>
                                <input id="attachment" type="file" class="form-control" name="attachment[]">
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="p-0">
                    <nav class="navbar fixed-bottom bg-primary shadow-lg py-3 border-top border-primary ripple">
                        <div class="container">
                            <p class="font-weight-bold text-center text-white h4 w-100">
                                UNGGAH PENGERJAAN
                            </p>
                        </div>
                    </nav>
                </button>

            </form>

        </div>
    </div>
</div>


</div>

<script src="{{asset('js/progressForm.js')}}"></script>

@endsection
