@extends('layouts.app',[
'title'=>'Project Anda',
'searchbar'=>false,
'navbar'=>true
])
@section('content')
<style>


</style>
<div class="container marginBottom">
    <div class="row align-items-center">
        <div class="col-2 pr-0">
            <a href="{{route('home')}}">
                <span class="material-icons text-dark" style="font-size:2rem">arrow_back</span>
            </a>
        </div>
        <div class="col-8 pl-0">
            <h2 class="font-weight-bold">Project Anda</h2>
        </div>
    </div>

    <div class="row mt-3 justify-content-center">
        <div class="col-12">
            <ul class="nav nav-tabs nav-justified mb-6 p-2" role="tablist">
                <li class="nav-item ">
                    <a href="#ongoing" class="nav-link active font-weight-bold" data-toggle="tab" role="tab"
                        aria-selected="true">Sedang Berjalan</a>
                </li>
                <li class="nav-item rounded">
                    <a href="#finished" class="nav-link  font-weight-bold" data-toggle="tab" role="tab"
                        aria-selected="false">Selesai</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="tab-content " role="tablist">
        <div id="ongoing" class="tab-pane fade active show " role="tabpanel">
            @foreach ($project_ongoing as $status)
            <div class="row mt-3 justify-content-center">
                <div class="col-md-12">
                    <div class="row align-items-center">
                        <div class="col-8 m-0 pr-0">
                            <p class="font-weight-bold text-secondary">
                                {{$status[0]->status->name.' ('.count($status).')'}}
                            </p>
                        </div>
                        <div class="col-4 m-0">
                            <a href="{{route('account.projects.status',$status[0]->status->id)}}"
                                class="text-dark text-right font-weight-bold">
                                <p>Lihat Semua <i class="fas fa-angle-right"></i></p>
                            </a>
                        </div>
                    </div>
                    @foreach ($status as $item)
                    <div class="card shadow roundedCorner cardRipple mb-3 borderLeft"
                        style="--borderLeft-color:{{$item->subtype->type->color}}">
                        <a href="{{route('project.details',['project'=>$item->id])}}" class="text-dark">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3 col-md-1 pr-0">
                                        <img src="{{$item->subtype->icon}}"
                                            class="img-fluid bg-light shadow mx-auto d-block">
                                    </div>
                                    <div class="col-9 col-md-11">
                                        <div class="row">
                                            <div class="col-8">
                                                <h5 class="font-weight-bold m-0">{{$item->title}}</h5>
                                                <p class="m-0">
                                                    {{isset($item->partner->name) ? $item->partner->name : 'Belum Ada Partner'}}
                                                </p>
                                                <p class="p-0 m-0">{{$item->subtype->title}}</p>
                                            </div>
                                            <div class="col-4">
                                                <h6 class="text-right">
                                                    {{\Carbon\Carbon::parse($item->created_at)->diffForHumans()}}
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center text-center mt-3">
                                    <div class="col-md-6 col-6">
                                        <span
                                            class="material-icons text-primary align-middle">account_balance_wallet</span>
                                        <h6 class="d-inline">@currency($item->budget)</h6>
                                    </div>
                                    <div class="col-md-6 col-6">
                                        <span class="d-block roundedCorner"
                                            style="background-color: {{$item->status->color}}">
                                            <small class=" text-white font-weight-bold p-1">
                                                {{$item->status->name}}
                                            </small>
                                        </span>
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
            @endforeach
        </div>
        <div id="finished" class="tab-pane fade " role="tabpanel">
            @foreach ($project_finished as $status)
            <div class="row mt-3 justify-content-center">
                <div class="col-md-12">
                    <div class="row align-items-center">
                        <div class="col-8 m-0 pr-0">
                            <p class="font-weight-bold text-secondary">
                                {{$status[0]->status->name.' ('.count($status).')'}}
                            </p>
                        </div>
                        <div class="col-4 m-0">
                            <a href="{{route('account.projects.status',$status[0]->status->id)}}"
                                class="text-dark text-right font-weight-bold">
                                <p>Lihat Semua <i class="fas fa-angle-right"></i></p>
                            </a>
                        </div>
                    </div>
                    @foreach ($status as $item)
                    <div class="card shadow roundedCorner cardRipple mb-3 borderLeft"
                        style="--borderLeft-color:{{$item->subtype->type->color}}">
                        <a href="{{route('project.details',['project'=>$item->id])}}" class="text-dark">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3 col-md-1 pr-0">
                                        <img src="{{$item->subtype->icon}}"
                                            class="img-fluid bg-light shadow mx-auto d-block">
                                    </div>
                                    <div class="col-9 col-md-11">
                                        <div class="row">
                                            <div class="col-8">
                                                <h5 class="font-weight-bold m-0">{{$item->title}}</h5>
                                                <p class="m-0">
                                                    {{isset($item->partner->name) ? $item->partner->name : 'Belum Ada Partner'}}
                                                </p>
                                                <p class="p-0 m-0">{{$item->subtype->title}}</p>
                                            </div>
                                            <div class="col-4">
                                                <h6 class="text-right">
                                                    {{\Carbon\Carbon::parse($item->created_at)->diffForHumans()}}
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center text-center mt-3">
                                    <div class="col-md-6 col-6">
                                        <span
                                            class="material-icons text-primary align-middle">account_balance_wallet</span>
                                        <h6 class="d-inline">@currency($item->budget)</h6>
                                    </div>
                                    <div class="col-md-6 col-6">
                                        <span class="d-block roundedCorner"
                                            style="background-color: {{$item->status->color}}">
                                            <small class=" text-white font-weight-bold p-1">
                                                {{$item->status->name}}
                                            </small>
                                        </span>
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
            @endforeach
        </div>
    </div>
</div>





@endsection
