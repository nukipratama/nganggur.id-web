@extends('admin.app')
@section('content')
<div class="mt-5">
    @if (isset($subtype->id))
    <h1>Ubah SubType - {{$subtype->title}}</h1>
    @else
    <h1>Tambah SubType</h1>
    @endif
    <form action="{{route('admin.subtype.post')}}" method="POST" enctype="multipart/form-data"> @csrf
        @if (isset($subtype->id))
        <input name="id" value="{{$subtype->id}}" hidden>
        @endif
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title"
                value="{{isset($subtype->title) ? $subtype->title : ''}}">
        </div>
        <div class="form-group">
            <label for="subtitle">Subtitle</label>
            <input type="text" class="form-control" id="subtitle" name="subtitle"
                value="{{isset($subtype->subtitle) ? $subtype->subtitle : ''}}">
        </div>
        <div class="form-group">
            <label for="type">Type</label>
            <select name="type" id="type" class="form-control">
                <option value="">--</option>
                @foreach (App\Type::all() as $item)
                <option value="{{$item->id}}"
                    {{isset($subtype->type->id) && $subtype->type->id===$item->id  ? 'selected' : ''}}>{{$item->title}}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="icon">Icon</label>
            <input type="file" class="form-control-file" id="icon" name="icon">
        </div>
        <button type="submit" class="btn btn-primary m-2 w-100 font-weight-bold">SUBMIT</button>
    </form>
</div>
@endsection
