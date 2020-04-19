<nav class="navbar navbar-light bg-white p-2 fixed-top border-bottom border-gray searchbar">
   <div class="container">
      <div class="row justify-content-center align-middle" style="width:100vw">
         <div class="col-12 ">
            <input id="name" placeholder="&#xF002; Cari Project, Pelanggan, dan Mitra disini.." type="text"
               class="form-control roundedCorner" name="name" value="{{ old('name') }}" required>
            @if (Auth::check())
            <form action="{{route('logout')}}" method="POST">
               @csrf
               <button type="submit">logout</button>
            </form>
            @endif
         </div>
      </div>
   </div>
</nav>
<script>
   $(window).scroll(function(e) {
      $('.searchbar')[$(window).scrollTop() >= 100 ? 'addClass' : 'removeClass']('searchbar-hide');
   });
</script>