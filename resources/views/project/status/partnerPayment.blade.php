<div class="row w-100 m-0 mt-2 py-4  roundedCorner shadow-lg">
    <div class="container marginBottom">
        <div class="row">
            <div class="col-12  my-1">
                <h1 class="font-weight-bold">Pencairan Dana</h1>
            </div>
            <div class="col-12 my-1">
                <div class="row">
                    @if ($project->withdraw_at && !$project->withdraw_verified_at)
                    <div class="col-12">
                        <p class="text-justify">Anda telah meminta pencairan dana. Selanjutnya, silahkan menunggu
                            konfirmasi pihak Nganggur.id terkait pencairan dana (maksimal 3 hari kerja).
                    </div>
                    @endif
                    @if ($project->withdraw_at && $project->withdraw_verified_at && $project->partner->details->bank_id
                    && $project->partner->details->bank_account && $project->partner->details->bank_account_name)
                    <div class="col-12">
                        <p class="text-justify">
                            Pencairan dana senilai @currency($project->withdraw['nominal']) telah dikirimkan ke
                            {{$project->partner->details->bank->name}} -
                            {{$project->partner->details->bank_account}} a.n
                            {{$project->partner->details->bank_account_name}} pada tanggal
                            {{\Carbon\Carbon::parse($project->withdraw_verified_at)->format('d M Y')}}.
                    </div>
                    @endif
                    @if (!$project->partner->details->bank_id || !$project->partner->details->bank_account ||
                    !$project->partner->details->bank_account_name )
                    @php
                    Session::put('partnerPayment', route('project.details',['project'=>$project->id]));
                    @endphp
                    <div class="col-12">
                        <p class="text-justify">Anda belum melengkapi informasi rekening. Informasi Rekening
                            digunakan sebagai tujuan pencairan dana project oleh Nganggur.id.
                            <br><a href="{{route('account.edit')}}">Klik disini</a> untuk melengkapi informasi rekening.
                        </p>
                    </div>
                    @endif
                    @if ($project->partner->details->bank_id && $project->partner->details->bank_account &&
                    $project->partner->details->bank_account_name && !$project->withdraw_verified_at)
                    <div class="col-12 text-center">
                        <p class="font-weight-bold text-left">Informasi Rekening Pembayaran :</p>
                        <h1 class="display-4 font-weight-bold">{{$project->partner->details->bank_account}}</h1>
                        <p class="font-weight-bold mb-0">
                            {{$project->partner->details->bank->name.' - '.$project->partner->details->bank->code}}</p>
                        <p class="font-weight-bold ">
                            {{$project->partner->details->bank_account_name}}</p>
                    </div>
                    <div class="col-12 text-center">
                        <p class="font-weight-bold text-left">Total Pencairan Dana :</p>
                        <h1 class="display-4 font-weight-bold mb-1">
                            @currency($project->withdraw['nominal'])</h1>
                        <p class="mb-0">Harga Project : <b>@currency($project->budget)</b></p>
                        <p>Biaya Administrasi : <b>{{$project->withdraw['fee']}}
                                (@currency($project->withdraw['fee_nominal']))</b></p>
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@if (!$project->withdraw_at && $project->partner->details->bank_id && $project->partner->details->bank_account &&
$project->partner->details->bank_account_name )
<form action="{{route('project.withdraw',['project'=>$project->id])}}">
    <button type="submit" class="p-0">
        <nav class="navbar fixed-bottom bg-primary shadow-lg py-3 border-top border-primary ripple">
            <div class="container">
                <p class="font-weight-bold text-center text-white h4 w-100">CAIRKAN DANA
                </p>
            </div>
        </nav>
    </button>
</form>
@endif
