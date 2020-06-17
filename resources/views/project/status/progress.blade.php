<div class="row w-100 m-0 mt-2 py-4  roundedCorner shadow-lg ">
   <div class="container marginBottom">
      <div class="row ">
         <div class="col-12  my-1">
            <h2 class="font-weight-bold d-inline">Pengerjaan</h2>
            @if ($project->partner_id === Auth::id())
            <a href="{{route('project.progress.form',['id'=>$project->id])}}" class="text-dark">
               <div class="row align-items-center float-right pr-3 ">
                  <span class="material-icons " style="font-size: 25pt">post_add</span>
                  <span class=" font-weight-bold">Unggah Pengerjaan</span>
               </div>
            </a>
            @endif

         </div>
         <div class="col-12">
            <ul class="timeline">
               @for ($i = 0; $i < 3; $i++) <li>
                  <p class="float-right">21 March, 2014</p>
                  <h5 class="font-weight-bold">New Web Design</h5>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque diam non nisi semper,
                     et
                     elementum lorem ornare. Maecenas placerat facilisis mollis. Duis sagittis ligula in sodales
                     vehicula....</p>
                  <div class="row pl-3 p-2 mt-0 align-items-center">
                     <span class="material-icons text-secondary">description</span>
                     <a href="">
                        <span class="text-dark font-weight-bold">Nama File.zip</span>
                     </a>
                  </div>
                  </li>
                  @endfor
            </ul>
         </div>
      </div>
   </div>
</div>

<nav class="navbar fixed-bottom navbar-light bg-light shadow-lg py-3 border-top">
   <div class="container">
      <div class="row justify-content-center align-items-center" style="width:100vw">
         <div class="col-6">
            <a href="">
               <button class="btn btn-outline-success roundedCorner w-100 font-weight-bold"
                  style="border-width: 2px !important">SELESAI</button>
            </a>
         </div>
         <div class="col-6">
            <a href="">
               <button class="btn btn-outline-primary roundedCorner w-100 font-weight-bold"
                  style="border-width: 2px !important">CHAT</button>
            </a>
         </div>
      </div>
   </div>
</nav>