<div class="row w-100 m-0 mt-2 py-4  roundedCorner shadow-lg">
   <div class="container">
      <div class="row">
         <div class="col-12  my-1">
            <h2 class="font-weight-bold">Penawaran</h2>
         </div>
         <div class="col-12 my-1">
            @if (count($bid))
            @foreach ($bid as $bids)
            <div class="card border-0 @if (Auth::id()===$project->user_id) cardRipple @endif roundedCorner">
               @if (Auth::id()===$project->user_id)
               <a href="{{route('project.bid',['id'=>$bids->id])}}" class="text-dark">
                  @endif
                  <div class="card-body p-2">
                     <div class="row">
                        <div class="col-2 col-md-1">
                           <img
                              src="{{ $bids->user->details->photo ? $bids->user->details->photo : asset('img/avatar_placeholder.png')}}"
                              class="img-fluid rounded-circle shadow">
                        </div>
                        <div class="col-10 col-md-11">
                           <div class="row">
                              <div class="col-8">
                                 <h5 class="">{{$bids->user->name}}</h5>
                                 <h5 class="font-weight-bold">Rp{{$bids->budget}} / {{$bids->duration}} hari</h5>
                              </div>
                              <div class="col-4">
                                 <h6 class="text-right">
                                    {{\Carbon\Carbon::parse($bids->created_at)->format('d M Y H:m:s')}}
                                 </h6>
                              </div>
                           </div>
                        </div>
                        <p class="m-3 p-3 text-justify show-read-more bg-light">{{$bids->message}}</p>
                     </div>
                  </div>
               </a>
            </div>
            @endforeach
            @else
            <h5 class="text-center marginBottom">Belum ada penawaran</h5>
            @endif
         </div>
      </div>
   </div>
</div>