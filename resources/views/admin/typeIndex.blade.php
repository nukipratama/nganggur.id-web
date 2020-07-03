@extends('admin.app')
@section('content')
<div class="container">
    <div class="row my-2">
        <h1>Daftar Type</h1>
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
                    <td class="align-middle">{{$item->icon}}</td>
                    <td class="align-middle">{{$item->color}}</td>
                    <td class="align-middle" colspan="2">
                        <form action="{{route('admin.type.ubah',['type'=>$item->id])}}" method="POST">
                            @method('PUT') @csrf <button class="btn btn-sm btn-primary m-1" type="submit">Ubah</button>
                        </form>
                        <form action="{{route('admin.type.hapus',['type'=>$item->id])}}" method="POST">
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
