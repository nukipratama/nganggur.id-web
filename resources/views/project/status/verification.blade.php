<div class="row w-100 m-0 mt-2 py-4  roundedCorner shadow-lg">
    <div class="container">
        <div class="row">
            <div class="col-12  my-1">
                <h2 class="font-weight-bold">Pembayaran sedang Diproses</h2>
            </div>
            <div class="col-12 my-1">
                @if ($project->partner_id === Auth::id())
                <div class="row marginBottom">
                    <div class="col-12 text-center">
                        <p class="pt-2 lead">Menunggu Verifikasi Pembayaran oleh Tim Nganggur.id</p>
                    </div>
                </div>
                @else
                <div class="row align-items-center justify-content-center ">
                    <div class="col-12 text-center">
                        <p class="pt-2 lead">Menunggu Verifikasi Pembayaran oleh Tim Nganggur.id</p>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold">Total Tagihan :</p>
                    </div>
                    <div class="col-6">
                        <a href="">
                            <p class="text-right font-weight-bold">Detail Tagihan</p>
                        </a>
                    </div>
                    <div class="col-12 text-center">
                        <h1 class=" font-weight-bold" id="invoice">@currency($project->invoice)</h1>
                    </div>
                </div>
                <div class="row mt-3 marginBottom">
                    <div class="col-12">
                        <p class="font-weight-bold">Bukti Pembayaran :</p>
                    </div>
                    <div class="col-12">
                        <a href="{{$project->payment->attachment}}" target="_blank">
                            <p class="font-weight-bold">{{basename($project->payment->attachment)}}</p>
                        </a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@if ($project->user_id === Auth::id())
<script src="{{asset('js/invoice.js')}}"></script>
@endif
