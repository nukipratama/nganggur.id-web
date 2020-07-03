@extends('layouts.app',[
'title'=>$project->title,
'searchbar'=>false,
'navbar'=>false
])
@section('content')
<style>
    body {
        background: #f4fbfc;
    }

</style>
<div class="container">
    <div class="row align-items-center">
        <div class="col-2 pr-0">
            <a href="{{Session::has('home') ? Session::pull('home') : url()->previous() }}">
                <span class="material-icons text-dark" style="font-size:2rem">arrow_back</span>
            </a>
        </div>
        <div class="col-8 pl-0">
            <h4 class="font-weight-bold">Detail Project</h4>
            <h6>{{$project->user->name}}</h6>
        </div>
        @if ($project->user_id===Auth::id() && $project->status_id < 4) <div class="col-2 text-right">
            <div class="btn-group dropleft">
                <a href="#" data-toggle="dropdown">
                    <span class="material-icons text-dark " style="font-size:25pt">more_vert</span>
                </a>
                <div class="dropdown-menu m-0 roundedCorner shadow border-0 ">
                    <a href="{{route('project.edit',['project'=>$project->id])}}">
                        <button class="dropdown-item" type="button"><i class="fas fa-pencil-alt"></i> Edit
                            Project</button>
                    </a>
                    @if ($project->status_id === 0)
                    <form action="{{route('project.delete',['project'=>$project->id])}}" method="POST"
                        id="delete_{{$project->id}}">
                        @csrf @method('delete')
                        <button class="dropdown-item" type="submit"
                            onclick="swal('Apakah anda yakin untuk <b>menghapus</b> {{$project->title}} ?','#delete_{{$project->id}}',event)">
                            <i class="fas fa-trash"></i>
                            Hapus Project</button>
                    </form>
                    @endif
                </div>
            </div>
    </div>
    @endif
</div>
<div class="row align-items-center justify-content-center my-1">
    <div class="col-4 col-md-2 text-center my-1">
        @if ($project->status_id === 0)
        <img src="{{$project->subtype->icon}}" class="img-fluid bg-light roundedCorner">
        @else
        @if (Auth::user()->role_id === 1)
        <img src="{{$project->partner->details->photo ? $project->partner->details->photo : asset('img/avatar_placeholder.png')}}"
            class="img-fluid bg-light roundedCorner">
        @elseif(Auth::user()->role_id === 2)
        <img src="{{$project->user->details->photo ? $project->user->details->photo : asset('img/avatar_placeholder.png')}}"
            class="img-fluid bg-light roundedCorner">
        @endif
        @endif
    </div>
    <div class="col-12 text-center my-1">
        <span class="text-break">
            Dibuat {{\Carbon\Carbon::parse($project->created_at)->format('d M Y')}}
        </span>
        <span class="d-block "><small class="text-white roundedCorner font-weight-bold p-1"
                style="background-color: {{$project->status->color}}">{{$project->status->name}}</small></span>
        @if ($project->status_id !== 5)
        <span class="d-block font-weight-bold mt-2 h5">@currency($project->budget) /
            {{$project->duration . ' hari'}}</span>
        @else
        <div class="starrating2 risingstar d-flex justify-content-center flex-row-reverse">
            <input type="radio" id="star5" name="star" value="5"
                {{$project->review->star === 5 ? 'checked' : 'disabled'}} /><label for="star5" title="5 star"></label>
            <input type="radio" id="star4" name="star" value="4"
                {{$project->review->star === 4 ? 'checked' : 'disabled'}} /><label for="star4" title="4 star"></label>
            <input type="radio" id="star3" name="star" value="3"
                {{$project->review->star === 3 ? 'checked' : 'disabled'}} /><label for="star3" title="3 star"></label>
            <input type="radio" id="star2" name="star" value="2"
                {{$project->review->star === 2 ? 'checked' : 'disabled'}} /><label for="star2" title="2 star"></label>
            <input type="radio" id="star1" name="star" value="1"
                {{$project->review->star === 1 ? 'checked' : 'disabled'}} /><label for="star1" title="1 star"></label>
        </div>
        <p class="font-weight-bold mb-0">Masukan oleh {{$project->user->name}}</p>
        <p class="font-italic text-center p-0">"{{$project->review->description}}"</p>
        @endif
    </div>
</div>

@if ($project->status_id === 0)
<div class="row my-1 ">
    <div class="card-body pt-0 pb-2">
        <div class="row align-items-center text-center justify-content-center">
            <div class="col-3">
                <h6 class="font-weight-bold">Kategori</h6>
                <small>{{$project->subtype->title}}</small>
            </div>
            <div class="col-3">
                <h6 class="font-weight-bold">Dilihat</h6>
                <h6>{{$project->views}}</h6>
            </div>
            <div class="col-3">
                <h6 class="font-weight-bold">Penawaran</h6>
                <h6>{{count($project->bids)}}</h6>
            </div>
            <div class="col-3">
                <h6 class="font-weight-bold">Mitra</h6>
                @if (isset($project->partner->name))
                <h6>
                    <a href="{{route('account.profile',['user'=>$project->partner->id])}}">
                        <small class="font-weight-bold">{{$project->partner->name}}</small>
                    </a>
                </h6>
                @else
                <h6>Belum Ada Mitra</h6>
                @endif
            </div>
        </div>
    </div>
</div>
@endif

<div class="row my-1">
    <div class="col-12 my-1 mb-3">
        <p class="lead font-weight-bold mb-0">{{$project->title}}</p>
        <p class="text-justify show-read-more mb-1">{{$project->description}}</p>
    </div>
</div>

</div>

<div class="bg-white">
    @includeWhen($project->status_id===0, 'project.status.bids', ['bid' => $project->bids])
    @if ($project->user_id === Auth::id() || $project->partner_id === Auth::id())
    @includeWhen($project->status_id===1, 'project.status.payment', ['project' => $project])
    @includeWhen($project->status_id===2, 'project.status.verification', ['project' => $project])
    @includeWhen($project->status_id===3, 'project.status.progress', ['project' => $project])
    @includeWhen($project->status_id===4 && $project->user_id===Auth::id(),'project.status.review' ,['project' =>
    $project])
    @includeWhen($project->status_id===4 && $project->partner_id===Auth::id(),
    'project.status.partnerPayment',['project'=>
    $project])
    @includeWhen($project->status_id===5, 'project.status.history', ['project' => $project])
    @endif
</div>
@if ($project->canBid)
<form action="{{route('project.bid.form',['project'=>$project->id])}}">
    <button type="submit" class="p-0">
        <nav class="navbar fixed-bottom bg-primary shadow-lg py-3 border-top border-primary ripple">
            <div class="container">
                <p class="font-weight-bold text-center text-white h4 w-100">AJUKAN PENAWARAN
                </p>
            </div>
        </nav>
    </button>
</form>
@endif
@if ($project->canUpdate)
<form action="{{route('project.bid.form',['project'=>$project->id])}}">
    <button type="submit" class="p-0">
        <nav class="navbar fixed-bottom bg-primary shadow-lg py-3 border-top border-primary ripple">
            <div class="container">
                <p class="font-weight-bold text-center text-white h4 w-100">UBAH PENAWARAN
                </p>
            </div>
        </nav>
    </button>
</form>
@endif
@endsection
