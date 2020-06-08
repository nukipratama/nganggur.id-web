<nav class="navbar navbar-light bg-white p-2 fixed-top border-bottom border-gray searchbar">
   <div class="container">
      <div class="row justify-content-center align-middle" style="width:100vw">
         <div class="col-12 ">
            <form action="{{route('search.query')}}">
               @csrf
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