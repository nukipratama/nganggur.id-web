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
            <a href="{{route('account.projects')}}">
                <span class="material-icons text-dark" style="font-size:2rem">arrow_back</span>
            </a>
        </div>
        <div class="col-8 pl-0">
            <h2 class="font-weight-bold">{{$project[0]->status->name}}</h2>
        </div>
    </div>

    <div class="row mt-3 justify-content-center">
        <div class="col-md-12">
            @foreach ($project as $item)
            <div class="card shadow roundedCorner cardRipple mb-3 borderLeft"
                style="--borderLeft-color:{{$item->subtype->type->color}}">
                <a href="{{route('project.details',['project'=>$item->id])}}" class="text-dark">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3 col-md-1 pr-0">
                                <img src="{{$item->subtype->icon}}" class="img-fluid bg-light shadow mx-auto d-block">
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
                                <span class="material-icons text-primary align-middle">account_balance_wallet</span>
                                <h6 class="d-inline">@currency($item->budget)</h6>
                            </div>
                            <div class="col-md-6 col-6">
                                <span class="d-block">
                                    <small class="roundedCorner text-white font-weight-bold p-1"
                                        style="background-color: {{$item->status->color}}">
                                        {{$item->status->name}}
                                    </small>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
    <div class="row justify-content-center">
        {{ $project->links() }}
    </div>





</div>





@endsection
