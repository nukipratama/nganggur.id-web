@extends('layouts.app',[
'title'=>'Terbaru',
'searchbar'=>true,
'navbar'=>Auth::check()
])
@section('content')
@includeWhen(!Auth::check(),'layouts.authbar')
<div class="container mt-5">
    <div class="row justify-content-center align-items-center text-center">
        <div class="col-6">
            <h2 class="font-weight-bold text-center my-2 align-middle">Project Terbaru</h2>
        </div>
        <div class="col-6 ">
            <img src="{{asset('img/projects.svg')}}" class="img-fluid w-50">
        </div>
    </div>
    <div class="row justify-content-center my-3">
        @foreach ($types as $item)
        <div class="col-6">
            <div class="card shadow roundedCorner cardRipple">
                <a href="{{route('projects.sorted',['type_title'=>$item->title])}}" class="text-dark">
                    <div class="card-body">
                        <h5 class="font-weight-bold text-center">{{$item->title}}</h5>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row justify-content-center my-3">
        <div class="col-md-12 ">
            @foreach ($recentProject as $item)
            <div class="card shadow roundedCorner cardRipple mb-3">
                <a href="/" class="text-dark">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2 col-md-1">
                                <img src="{{$item->user->details->photo ? $item->user->details->photo : asset('img/avatar_placeholder.png')}}"
                                    class="img-fluid rounded-circle shadow">
                            </div>
                            <div class="col-10 col-md-11">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="">{{$item->user->name}}</h5>
                                    </div>
                                    <div class="col-6">
                                        <h6 class="text-right">{{$item->created_at}}</h6>
                                    </div>
                                </div>
                                <h5 class="font-weight-bold">{{$item->title}}</h5>
                                <p>{{$item->subtype->title}}</p>
                            </div>
                        </div>
                        <div class="row mt-3 align-items-center text-center">
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
                                <h6 class="d-inline">Rp {{$item->budget}}</h6>
                            </div>
                            <div class="col-md-3 col-6">
                                <span class="material-icons text-primary align-middle">assignment</span>
                                <h6 class="d-inline">{{$item->status->name}}</h6>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
            <div class="row justify-content-center">
                {{ $recentProject->links() }}
            </div>
        </div>
    </div>
</div>
@endsection