@extends('admin.app')
@section('content')
<div class="mt-5">
    @if (isset($type->id))
    <h1>Ubah Type - {{$type->title}}</h1>
    @else
    <h1>Tambah Type</h1>
    @endif
    <form action="{{route('admin.type.post')}}" method="POST" enctype="multipart/form-data"> @csrf
        @if (isset($type->id))
        <input name="id" value="{{$type->id}}" hidden>
        @endif
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title"
                value="{{isset($type->title) ? $type->title : ''}}">
        </div>
        <div class="form-group">
            <label for="subtitle">Subtitle</label>
            <input type="text" class="form-control" id="subtitle" name="subtitle"
                value="{{isset($type->subtitle) ? $type->subtitle : ''}}">
        </div>
        <div class="form-group">
            <label for="color">Color (Hex Code)</label>
            <input type="text" class="form-control" id="color" name="color"
                value="{{isset($type->color) ? $type->color : ''}}">
        </div>
        <div class="form-group">
            <label for="icon">Icon</label>
            <input type="file" class="form-control-file" id="icon" name="icon">
        </div>
        <button type="submit" class="btn btn-primary m-2 w-100 font-weight-bold">SUBMIT</button>
    </form>
</div>
@endsection
