@extends('layouts.app',[
'title'=>$chat->project->title.' - Chat',
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
            <a href="{{url()->previous()}}">
                <span class="material-icons text-dark" style="font-size:30pt">arrow_back</span>
            </a>
        </div>
        <div class="col-8 pl-0">
            <h6>{{$chat->project->title}}</h6>
            <h4 class="font-weight-bold">{{$chat->name->name}}</h4>
        </div>
    </div>
    <hr class="bg-light">
    {{$chat}}
</div>

@endsection
