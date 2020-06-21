@extends('layouts.app',[
'title'=>'Pencarian',
'searchbar'=>true,
'navbar'=>Auth::check()
])
@section('content')
@includeWhen(!Auth::check(),'layouts.authbar')
<div class="container mt-5 marginBottom">
    <div class="row justify-content-center align-items-center text-center">
        <div class="col-6">
            <h2 class="font-weight-bold text-center my-2 align-middle">Hasil Pencarian</h2>
            <p class="show-read-more">Kata Kunci "{{$query}}"</p>
        </div>
        <div class="col-6 ">
            <img src="{{asset('img/search.svg')}}" class="img-fluid w-50">
        </div>
    </div>

    <div class="row justify-content-center my-3">
        <div class="col-md-12">
            <div class="row align-items-center">
                <div class="col-6 m-0">
                    <p class="font-weight-bold lead">Project</p>
                </div>
                <div class="col-6 m-0">
                    <form action="{{route('search.more')}}" id="project">
                        <input type="hidden" name="query" value="{{$query}}">
                        <input type="hidden" name="type" value="Project">
                    </form>
                    @if ($result['project']->isNotEmpty())
                    <a onclick="$('#project').submit()" class="text-dark text-right font-weight-bold"
                        style="cursor: pointer">
                        <p>Lihat Semua <i class="fas fa-angle-right"></i></p>
                    </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-12 ">
            @if ($result['project']->isEmpty())
            <p class="text-center">Tidak ada Project dengan Kata Kunci "{{$query}}"</p>
            @endif
            @foreach ($result['project'] as $item)
            <div class="card shadow roundedCorner cardRipple mb-3">
                <a href="{{route('project.details',['id'=>$item->id])}}" class="text-dark">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2 col-md-1 pr-0">
                                <img src="{{$item->user->details->photo ? $item->user->details->photo : asset('img/avatar_placeholder.png')}}"
                                    class="img-fluid rounded-circle shadow">
                            </div>
                            <div class="col-10 col-md-11">
                                <div class="row">
                                    <div class="col-8">
                                        <h5 class="">{{$item->user->name}}</h5>
                                        <h5 class="font-weight-bold">{{$item->title}}</h5>
                                    </div>
                                    <div class="col-4">
                                        <h6 class="text-right">
                                            {{\Carbon\Carbon::parse($item->created_at)->format('d M Y H:m:s')}}
                                        </h6>
                                    </div>
                                </div>
                                <p>{{$item->subtype->title}}</p>
                            </div>
                        </div>
                        <div class="row align-items-center text-center">
                            <div class="col-md-3 col-6 ">
                                <span class="material-icons text-primary align-middle">visibility</span>
                                <h6 class="d-inline">{{$item->views}}</h6>
                            </div>
                            <div class=" col-md-3 col-6">
                                <span class="material-icons text-primary align-middle">date_range</span>
                                <h6 class="d-inline">{{$item->duration}} hari</h6>
                            </div>
                            <div class="col-md-3 col-6">
                                <span class="material-icons text-primary align-middle">account_balance_wallet</span>
                                <h6 class="d-inline">@currency($item->budget)</h6>
                            </div>
                            <div class="col-md-3 col-6">
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

    <div class="row justify-content-center my-3">
        <div class="col-md-12 ">
            <div class="row align-items-center">
                <div class="col-6 m-0">
                    <p class="font-weight-bold lead">Pelanggan</p>
                </div>
                <div class="col-6 m-0">
                    <form action="{{route('search.more')}}" id="pelanggan">
                        <input type="hidden" name="query" value="{{$query}}">
                        <input type="hidden" name="type" value="Pelanggan">
                    </form>
                    @if ($result['pelanggan']->isNotEmpty())
                    <a onclick="$('#pelanggan').submit()" class="text-dark text-right font-weight-bold"
                        style="cursor: pointer">
                        <p>Lihat Semua <i class="fas fa-angle-right"></i></p>
                    </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-12 ">
            @if ($result['pelanggan']->isEmpty())
            <p class="text-center">Tidak ada Pelanggan dengan Kata Kunci "{{$query}}"</p>
            @endif
            @foreach ($result['pelanggan'] as $item)
            <div class="card shadow roundedCorner cardRipple mb-3">
                <a href="{{route('account.profile',['id'=>$item->id])}}" class="text-dark">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2 col-md-1 pr-0">
                                <img src="{{$item->details->photo ? $item->details->photo : asset('img/avatar_placeholder.png')}}"
                                    class="img-fluid rounded-circle shadow">
                            </div>
                            <div class="col-10 col-md-11">
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="">{{$item->name}}</h5>
                                        <p class="font-weight-bold">{{$item->role->title}}</p>
                                    </div>
                                </div>
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
    <div class="row justify-content-center my-3">
        <div class="col-md-12 ">
            <div class="row align-items-center">
                <div class="col-6 m-0">
                    <p class="font-weight-bold lead">Mitra</p>
                </div>
                <div class="col-6 m-0">
                    <form action="{{route('search.more')}}" id="mitra">
                        <input type="hidden" name="query" value="{{$query}}">
                        <input type="hidden" name="type" value="Mitra">
                    </form>
                    @if ($result['mitra']->isNotEmpty())
                    <a onclick="$('#mitra').submit()" class="text-dark text-right font-weight-bold"
                        style="cursor: pointer">
                        <p>Lihat Semua <i class="fas fa-angle-right"></i></p>
                    </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-12 ">
            @if ($result['mitra']->isEmpty())
            <p class="text-center">Tidak ada Mitra dengan Kata Kunci "{{$query}}"</p>
            @endif
            @foreach ($result['mitra'] as $item)
            <div class="card shadow roundedCorner cardRipple mb-3">
                <a href="{{route('account.profile',['id'=>$item->id])}}" class="text-dark">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2 col-md-1 pr-0">
                                <img src="{{$item->details->photo ? $item->details->photo : asset('img/avatar_placeholder.png')}}"
                                    class="img-fluid rounded-circle shadow">
                            </div>
                            <div class="col-10 col-md-11">
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="">{{$item->name}}</h5>
                                        <p class="font-weight-bold">{{$item->role->title}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @if ($loop->iteration === 3)
            @break
            @endif
            @endforeach
        </div>
    </div>


</div>
@endsection