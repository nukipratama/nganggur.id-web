@extends('admin.app')
@section('content')
<div class="container">
    <div class="row my-2">
        <div class="col-6">
            <h1>Daftar Type</h1>
        </div>
        <div class="col-6 text-right">
            <a href="{{route('admin.type.add')}}">
                <button class="btn btn-lg btn-primary m-2">Tambah Type</button>
            </a>
        </div>
    </div>
    <div class="row">
        <table class="table table-striped text-center table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Subtitle</th>
                    <th scope="col">Icon</th>
                    <th scope="col">Color</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <th class="align-middle" scope="row">{{$item->id}}</th>
                    <td class="align-middle">{{$item->title}}</td>
                    <td class="align-middle">{{$item->subtitle}}</td>
                    <td class="align-middle">
                        <img src="{{$item->icon}}" class="img-fluid" style="max-width:200px">
                    </td>
                    <td class="align-middle">{{$item->color}}</td>
                    <td class="align-middle" colspan="2">
                        <a href="{{route('admin.type.ubah',['type'=>$item->id])}}">
                            <button class="btn btn-sm btn-primary m-1" type="submit">Ubah</button>
                        </a>
                        <form action="{{route('admin.type.hapus',['type'=>$item->id])}}" method="POST">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger m-1" type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="row my-2">
        <div class="col-6">
            <h1>Daftar Subtype</h1>
        </div>
        <div class="col-6 text-right">
            <a href="{{route('admin.subtype.add')}}">
                <button class="btn btn-lg btn-primary m-2">Tambah Subtype</button>
            </a>
        </div>
    </div>
    <div class="row">
        <table class="table table-striped text-center table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Subtitle</th>
                    <th scope="col">Icon</th>
                    <th scope="col">Type</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data2 as $item)
                <tr>
                    <th class="align-middle" scope="row">{{$item->id}}</th>
                    <td class="align-middle">{{$item->title}}</td>
                    <td class="align-middle">{{$item->subtitle}}</td>
                    <td class="align-middle">
                        <img src="{{$item->icon}}" class="img-fluid" style="max-width:200px">
                    </td>
                    <td class="align-middle">{{$item->type->title}}</td>
                    <td class="align-middle" colspan="2">
                        <a href="{{route('admin.subtype.ubah',['subtype'=>$item->id])}}">
                            <button class="btn btn-sm btn-primary m-1" type="submit">Ubah</button>
                        </a>
                        <form action="{{route('admin.subtype.hapus',['subtype'=>$item->id])}}" method="POST">
                            @method('delete') @csrf <button class="btn btn-sm btn-danger m-1"
                                type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection
