@extends('layouts.app',[
'title'=>'Pencarian '.$type,
'searchbar'=>true,
'navbar'=>Auth::check()
])
@section('content')
@includeWhen(!Auth::check(),'layouts.authbar')
<div class="container mt-5 marginBottom">

    <div class="row justify-content-center align-items-center text-center">
        <div class="col-6">
            <h2 class="font-weight-bold text-center my-2 align-middle">Hasil Pencarian {{$type}}</h2>
            <p class="show-read-more">Kata Kunci "{{$query}}"</p>
        </div>
        <div class="col-6 ">
            <img src="{{asset('img/projects.svg')}}" class="img-fluid bg-light w-50">
        </div>
    </div>

    @switch($type)
    @case('Project')
    <div class="row justify-content-center my-3">
        <div class="col-md-12 ">
            @foreach ($data as $item)
            <div class="card shadow roundedCorner cardRipple mb-3 borderLeft"
                style="--borderLeft-color:{{$item->subtype->type->color}}">
                <a href="{{route('project.details',['project'=>$item->id])}}" class="text-dark">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2 col-md-1 pr-0">
                                <img src="{{$item->user->details->photo ? $item->user->details->photo : asset('img/avatar_placeholder.png')}}"
                                    class="img-fluid bg-light rounded-circle shadow">
                            </div>
                            <div class="col-10 col-md-11">
                                <div class="row">
                                    <div class="col-8">
                                        <h5 class="">{{$item->user->name}}</h5>
                                        <h5 class="font-weight-bold">{{$item->title}}</h5>
                                    </div>
                                    <div class="col-4">
                                        <h6 class="text-right">
                                            {{\Carbon\Carbon::parse($item->created_at)->diffForHumans()}}
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
            @endforeach
            <div class="row justify-content-center">
                {{ $data->links() }}
            </div>
        </div>
    </div>
    @break
    @case('Pelanggan')
    <div class="row justify-content-center my-3">
        <div class="col-md-12 ">
            @foreach ($data as $item)
            <div class="card shadow roundedCorner cardRipple mb-3">
                <a href="{{route('account.profile',['user'=>$item->id])}}" class="text-dark">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2 col-md-1 pr-0">
                                <img src="{{$item->details->photo ? $item->details->photo : asset('img/avatar_placeholder.png')}}"
                                    class="img-fluid bg-light rounded-circle shadow">
                            </div>
                            <div class="col-10 col-md-11">
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="">{{$item->name}}</h5>
                                        <p class="font-weight-bold">{{$item->role->title->value}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
            <div class="row justify-content-center">
                {{ $data->links() }}
            </div>
        </div>
    </div>
    @break
    @case('Mitra')
    <div class="row justify-content-center my-3">
        <div class="col-md-12 ">
            @foreach ($data as $item)
            <div class="card shadow roundedCorner cardRipple mb-3">
                <a href="{{route('account.profile',['user'=>$item->id])}}" class="text-dark">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2 col-md-1 pr-0">
                                <img src="{{$item->details->photo ? $item->details->photo : asset('img/avatar_placeholder.png')}}"
                                    class="img-fluid bg-light rounded-circle shadow">
                            </div>
                            <div class="col-10 col-md-11">
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="">{{$item->name}}</h5>
                                        <p class="font-weight-bold">{{$item->role->title->value}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
            <div class="row justify-content-center">
                {{ $data->links() }}
            </div>
        </div>
    </div>
    @break
    @endswitch

</div>
@endsection
