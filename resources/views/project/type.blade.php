@extends('layouts.app',[
'title'=>'Tambah Project',
'searchbar'=>false,
'navbar'=>false
])
@section('content')
<style>


</style>
<div class="container">
    <div class="row align-items-center">
        <div class="col-10">
            <h4 class="font-weight-bold">Tambah Project</h4>
        </div>
        <div class="col-2 text-right">
            <a href="{{route('home.index')}}">
                <span class="material-icons text-dark" style="font-size:2rem">close</span>
            </a>
        </div>
    </div>
    <div class="row justify-content-center">
        @foreach ($type as $item)
        <div class="col-12 m-2">
            <div class="card shadow roundedCorner cardRipple">
                <a href="{{route('project.subtype',['type'=>$item->id])}}" class="text-dark">
                    <div class="card-body" onclick="$(this).closest('form').submit();">
                        <div class="row align-items-center">
                            <div class="col-3 text-center">
                                <img src="{{$item->icon}}" class="img-fluid bg-light rounded shadow">
                            </div>
                            <div class="col-7 text-left p-0">
                                <h4 class="font-weight-bold">{{$item->title}}</h4>
                                <p>{{$item->subtitle}}</p>
                            </div>
                            <div class="col-2">
                                <span class="material-icons text-dark" style="font-size:25pt">arrow_forward_ios</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
