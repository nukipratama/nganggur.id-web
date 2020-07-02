@extends('admin.app')
@section('content')
@if (isset($data))
<table class="table table-striped text-center table-bordered">

    @if ($data->page === 'pelanggan' || $data->page === 'mitra' )
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nama</th>
            <th scope="col">Email</th>
            {!!$data->page === "mitra" ? '<th scope="col">Tipe Mitra</th>' : '' !!}
            <th scope="col">Foto</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <th class="align-middle" scope="row">{{$item->id}}</th>
            <td class="align-middle">{{$item->name}}</td>
            <td class="align-middle">{{$item->email}}</td>
            {!!$data->page === "mitra" ? '<td class="align-middle">'.$item->type->title.'</td>' : '' !!}
            <td class="align-middle"><img src="{{$item->details->photo}}" style="max-height:100px"></td>
        </tr>
        @endforeach
    </tbody>
    @endif

    @if ($data->page === 'pembayaran')
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Judul Project</th>
            <th scope="col">Harga Project + Kode Unik</th>
            <th scope="col">Bukti Pembayaran</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <th scope="row">{{$item->id}}</th>
            <td>{{$item->title}}</td>
            <td>@currency($item->budget + $item->id)</td>
            <td><a href="{{$item->payment->attachment}}" target="_blank">{{$item->payment->attachment}}</a></td>
            <td colspan="2">
                <form action="{{route('admin.pembayaran.terima',['project'=>$item->id])}}" method="POST">
                    @method('PUT') @csrf <button class="btn btn-sm btn-success m-1" type="submit">Terima</button>
                </form>
                <form action="{{route('admin.pembayaran.tolak',['project'=>$item->id])}}" method="POST">
                    @method('PUT') @csrf <button class="btn btn-sm btn-danger m-1" type="submit">Tolak</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
    @endif

    @if ($data->page === 'project')
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Judul Project</th>
            <th scope="col">Harga Project + Kode Unik</th>
            <th scope="col">Status</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <th scope="row">{{$item->id}}</th>
            <td>{{$item->title}}</td>
            <td>@currency($item->budget + $item->id)</td>
            <td>
                <div class="badge rounded text-white border-0" style="background-color: {{$item->status->color}}">
                    {{$item->status->name}}
                </div>
            </td>
            <td>
                <button class="btn btn-primary btn-sm">Detail</button>
            </td>
        </tr>
        @endforeach
    </tbody>
    @endif

    @if ($data->page === 'pencairan')
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Judul Project</th>
            <th scope="col">Nama Mitra</th>
            <th scope="col">Bank</th>
            <th scope="col">Nama Rek</th>
            <th scope="col">Rekening</th>
            <th scope="col">Total</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <th scope="row">{{$item->id}}</th>
            <td>{{$item->title}}</td>
            <td>{{$item->partner->name}}</td>
            <td>{{$item->partner->details->bank->name}}</td>
            <td>{{$item->partner->details->bank_account_name}}</td>
            <td>{{$item->partner->details->bank_account}}</td>
            @php
            $total = $item->budget * 0.05;
            @endphp
            <td>@currency($item->budget - $total)</td>
            <td colspan="2">
                <form action="{{route('admin.pencairan.terima',['project'=>$item->id])}}" method="POST">
                    @method('PUT') @csrf <button class="btn btn-sm btn-success m-1" type="submit">Terima</button>
                </form>
                <form action="{{route('admin.pencairan.tolak',['project'=>$item->id])}}" method="POST">
                    @method('PUT') @csrf <button class="btn btn-sm btn-danger m-1" type="submit">Tolak</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
    @endif


</table>
@endif
@endsection
