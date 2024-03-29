<div class="row w-100 m-0 mt-2 py-4  roundedCorner shadow-lg">
    <div class="container">
        <div class="row">
            <div class="col-12  my-1">
                <h1 class="font-weight-bold">Pembayaran</h1>
            </div>
            <div class="col-12 my-1">
                @if ($project->partner_id === Auth::id())
                <p class="marginBottom">Menunggu Pembayaran oleh Pemilik Project</p>
                @else
                <div class="row">
                    <div class="col-6">
                        <p class="font-weight-bold">Total Tagihan :</p>
                    </div>
                    <div class="col-6">
                        <a href="">
                            <p class="text-right font-weight-bold">Detail Tagihan</p>
                        </a>
                    </div>
                    <div class="col-12 text-center">
                        <h1 class="display-4 font-weight-bold" id="invoice">@currency($project->invoice)</h1>
                    </div>
                    <div class="col-12 my-2">
                        <p class="font-weight-bold">Pilih Metode Pembayaran</p>
                        <p class="text-secondary font-weight-bold">Transfer Bank</p>
                        <form action="{{route('project.pay.instruction',['project'=>$project->id])}}">
                            <div class="bank roundedCorner cardRipple mb-1 p-2"
                                onclick="$(this).closest('form').submit()" style="cursor: pointer">
                                <input type="hidden" name="payment_method" value="mandiri">
                                <div class="row justify-content-center align-items-center mx-2">
                                    <div class="col-2  p-0">
                                        <img src="{{asset('img/bank/mandiri.png')}}"
                                            class="img-fluid bg-light bg-primary roundedCorner">
                                    </div>
                                    <div class="col-8 p-0 ">
                                        <span class="pl-3 font-weight-bold">Bank Mandiri</span>
                                    </div>
                                    <div class="col-2 p-0 text-right">
                                        <span class="material-icons text-dark"
                                            style="font-size:2rem">keyboard_arrow_right</span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
