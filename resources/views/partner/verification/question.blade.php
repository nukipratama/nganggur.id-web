@extends('layouts.app',[
'title'=>'Ujian',
'searchbar'=>false,
'navbar'=>false
])
@section('content')
<div class="container marginBottom">
    <div class="row align-items-center">
        <div class="col-2 pr-0">
            <a href="{{route('home.index')}}">
                <span class="material-icons text-dark" style="font-size:2rem">arrow_back</span>
            </a>
        </div>
        <div class="col-8 pl-0">
            <h2 class="font-weight-bold">Ujian Verifikasi Mitra</h2>
            <p>{{auth()->user()->type->title}}</p>
        </div>
    </div>
    <div class="row justify-content-center  align-items-center text-center">
        <div class="col-12 col-md-6">
            <img src="{{asset('img/question.svg')}}" class="img-fluid mb-3" style="max-width: 300px">
        </div>
    </div>
    <div class="row justify-content-center align-items-center">
        <div class="col-12">
            <p>Berikut diberikan pertanyaan terkait kemampuan anda untuk bergabung sebagai Mitra Nganggur.id, silahkan
                jawab pertanyaan pada perangkat anda, dan kirimkan jawaban dalam <b>format file pdf</b>.</p>
            <ol>
                @foreach ($questions as $question)
                <li>{{$question}}</li>
                @endforeach
            </ol>
        </div>
    </div>
    <form action="{{route('partner.upload')}}" method="POST" enctype="multipart/form-data" id="exam">
        @csrf
        <div class="form-group row justify-content-center align-items-center">
            <div class="col-md-12 px-2">
                <label for="answer" class="px-2 font-weight-bold">Unggah Jawaban</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text  font-weight-bold" style="border-radius:15px 0 0 15px">
                            PILIH
                        </div>
                    </div>
                    <input id="answer" type="file" class="form-control @error('answer') is-invalid @enderror"
                        name="answer" style="border-radius:0 15px 15px 0">
                    @error('answer')
                    <span class="invalid-feedback px-2" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>
        <button type="submit" class="p-0 border-0"
            onclick="swal('Pastikan anda telah mengunggah jawaban terbaik, Apakah anda yakin untuk mengirim jawaban?','#exam',event)">
            <nav class="navbar fixed-bottom bg-primary shadow-lg py-3 border-top border-primary ripple">
                <div class="container">
                    <p class="font-weight-bold text-center text-white h4 w-100">KIRIMKAN JAWABAN
                    </p>
                </div>
            </nav>
        </button>
    </form>


</div>
@endsection
