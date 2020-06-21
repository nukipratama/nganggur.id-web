<nav class="navbar navbar-light bg-white p-2 fixed-top border-bottom border-gray searchbar">
   <div class="container">
      <div class="row align-middle" style="width:100vw">
         <div class="col-1 m-0 p-0">
            <img src="{{asset('favicon/favicon-32x32.png')}}" alt="Nganggur.id Logo" class="img-fluid bg-light">
         </div>
         <div class="col-11 m-0 p-0 pl-2">
            <form action="{{route('search.query')}}">
               <input id="query" placeholder="&#xF002; Cari Project, Pelanggan, dan Mitra disini.." type="text"
                  class="form-control roundedCorner" name="query"
                  value="{{ old('query')}}{{isset($query) ? $query : '' }}" required>
            </form>
         </div>
      </div>
   </div>
</nav>
<script>
   $(window).scroll(function(e) {
      $('.searchbar')[$(window).scrollTop() >= 100 ? 'addClass' : 'removeClass']('searchbar-hide');
   });
</script>