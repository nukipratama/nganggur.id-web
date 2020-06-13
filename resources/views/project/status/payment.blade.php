<div class="row w-100 m-0 mt-2 py-4  roundedCorner shadow-lg">
   <div class="container">
      <div class="row">
         <div class="col-12  my-1">
            <h2 class="font-weight-bold">Pembayaran</h2>
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
                  <h2 class="font-weight-bold" id="invoice">@currency($project->invoice)</h2>
               </div>
               <div class="col-12 my-2">
                  <p class="font-weight-bold">Pilih Metode Pembayaran</p>
                  <p class="text-secondary font-weight-bold">Transfer Bank</p>
                  @for ($i = 0; $i < 5; $i++) <div class="bank mb-1">
                     <div class="row justify-content-center align-items-center mx-2">
                        <div class="col-2  p-0">
                           <img src="{{asset('img/bank/mandiri.png')}}" class="img-fluid bg-primary roundedCorner">
                        </div>
                        <div class="col-8 p-0 ">
                           <span class="pl-3 font-weight-bold">Bank Mandiri</span>
                        </div>
                        <div class="col-2 p-0 text-right">
                           <a href="">
                              <span class="material-icons text-dark" style="font-size:30pt">keyboard_arrow_right</span>
                           </a>
                        </div>
                     </div>
                     <hr class="bg-secondary">
               </div>@endfor
            </div>
         </div>
         @endif
      </div>
   </div>
</div>
</div>
<script src="{{asset('js/invoice.js')}}"></script>