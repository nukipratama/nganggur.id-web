<div class="row w-100 m-0 mt-2 py-4  roundedCorner shadow-lg">
    <div class="container marginBottom">
        <form action="{{route('project.review',['project'=>$project->id])}}" method="POST">
            @csrf
            <div class="col-12  my-1 p-0">
                <h1 class="font-weight-bold">Beri Nilai</h1>
            </div>
            <div class="form-group row justify-content-center">
                <div class="col-12 my-1">
                    <div class="starrating risingstar d-flex justify-content-center flex-row-reverse">
                        <input type="radio" id="star5" name="star" value="5" /><label for="star5"
                            title="5 star"></label>
                        <input type="radio" id="star4" name="star" value="4" /><label for="star4"
                            title="4 star"></label>
                        <input type="radio" id="star3" name="star" value="3" /><label for="star3"
                            title="3 star"></label>
                        <input type="radio" id="star2" name="star" value="2" /><label for="star2"
                            title="2 star"></label>
                        <input type="radio" id="star1" name="star" value="1" /><label for="star1"
                            title="1 star"></label>
                    </div>
                    @error('star')
                    <span class="invalid-feedback px-2 " role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row justify-content-center px-2">
                <div class="col-12">
                    <label for="description" class="px-2 font-weight-bold">Beri Masukan</label>
                    <div class="input-group">
                        <textarea id="description"
                            placeholder="contoh : Project yang dikerjakan berjalan dengan lancar. Hasil pekerjaan sesuai dengan yang diharapkan."
                            name="description"
                            class="form-control roundedCorner @error('description') is-invalid @enderror"
                            rows="5">{{old('description')}}</textarea>
                        @error('description')
                        <span class="invalid-feedback px-2 " role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>

            <button type="submit" class="p-0">
                <nav class="navbar fixed-bottom bg-primary shadow-lg py-3 border-top border-primary ripple">
                    <div class="container">
                        <p class="font-weight-bold text-center text-white h4 w-100">
                            KIRIM NILAI
                        </p>
                    </div>
                </nav>
            </button>
        </form>

    </div>
</div>
