@if ($project->user_id === Auth::id() || $project->partner_id === Auth::id())
<div class="row w-100 m-0 mt-2 py-4  roundedCorner shadow-lg ">
    <div class="container marginBottom">
        <div class="row ">
            @if ($project->partner_finish)
            <div class="col-12">
                <p><b>{{$project->partner->name}}</b> telah meminta untuk menyelesaikan <b>{{$project->title}}</b>.
                    Silahkan pilih tombol Selesai dibawah <b>jika project sudah selesai</b>. Dengan menekan tombol
                    Selesai, <b>{{$project->title}}</b> akan <b>ditandai selesai</b> dan pembayaran proyek akan
                    dikirimkan kepada <b>{{$project->partner->name}}</b>.</p>
            </div>
            @endif
            <div class="col-12 my-1">
                <h2 class="font-weight-bold d-inline">Pengerjaan</h2>
                @if ($project->partner_id === Auth::id())
                <a href="{{route('project.progress.form',['project'=>$project->id])}}" class="text-dark">
                    <div class="row align-items-center float-right pr-3 ">
                        <span class="material-icons " style="font-size: 25pt">post_add</span>
                        <span class=" font-weight-bold">Unggah Pengerjaan</span>
                    </div>
                </a>
                @endif
            </div>

            <div class="col-12">
                <ul class="timeline">
                    @foreach ($project->progress as $item)
                    <li style="--timeline-color:{{$item->step !== 0 ? '#DBA66C' : '#3F83E1' }}">
                        <p class=" float-right">{{\Carbon\Carbon::parse($item->created_at)->format('d M Y')}}</p>
                        <h5 class="font-weight-bold d-inline">{{$item->title}}</h5>
                        <br>
                        @if ($item->step !== 0) @if ($project->user_id === Auth::id() && !$item->verified_at &&
                        !$item->refused_at)
                        <form method="post" class="d-inline" id="verify_{{$item->id}}"
                            action="{{route('project.progress.verify',['project'=>$item->project_id,'progress'=>$item->id])}}">
                            @csrf @method('PUT')
                            <button type="submit" class="p-0 border-0 bg-white"
                                onclick="swal('Apakah anda yakin untuk <b>terima</b> pengerjaan <b>{{$item->title}}</bterima> ?','#verify_{{$item->id}}',event)">
                                <div class="badge badge-success">Terima <i class="fas fa-check-circle"></i>
                                </div>
                            </button>
                        </form>
                        <form method="post" class="d-inline" id="refuse_{{$item->id}}"
                            action="{{route('project.progress.refuse',['project'=>$item->project_id,'progress'=>$item->id])}}">
                            @csrf @method('PUT')
                            <button type="submit" class="p-0 border-0 bg-white"
                                onclick="swal('Apakah anda yakin untuk <b>menolak</b> pengerjaan <b>{{$item->title}}</b> ?','#refuse_{{$item->id}}',event)">
                                <div class="badge badge-danger font-weight-bold">Tolak <i
                                        class="fas fa-times-circle"></i>
                                </div>
                            </button>
                        </form>
                        @elseif($project->partner_id === Auth::id() && !$item->verified_at && !$item->refused_at)
                        <div class="badge badge-light border border-secondary text-secondary">
                            Belum diverifikasi
                        </div>
                        @endif
                        @if ($item->verified_at)
                        <div class="badge badge-light border border-success text-success">
                            Pengerjaan Diterima
                        </div>
                        @elseif($item->refused_at)
                        <div class="badge badge-light border border-danger text-danger">
                            Pengerjaan ditolak
                        </div>
                        @endif @endif
                        <p class="my-1 text-break show-read-more">{{$item->description}}</p>
                        @if (isset($item->attachment))
                        @foreach (json_decode($item->attachment) as $item)
                        <div class="row pl-3 p-1 mb-3 align-items-center">
                            <span class="material-icons text-secondary">description</span>
                            <a href="{{$item}}" target="_blank">
                                <span class="text-dark font-weight-bold">{{basename($item)}}</span>
                            </a>
                        </div>
                        @endforeach
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<nav class="navbar fixed-bottom navbar-light bg-light shadow-lg py-3 border-top">
    <div class="container">
        <div class="row justify-content-center align-items-center" style="width:100vw">
            @if (Auth::user()->role_id === 1 || !$project->partner_finish)
            <div class="col-6">
                <form action="{{route('project.finish',['project'=>$project->id])}}" method="post" id="finish">
                    @csrf @method('PUT')
                    <button type="submit" class="btn btn-outline-success roundedCorner w-100 font-weight-bold"
                        onclick="swal('Apakah anda yakin untuk <b>menandai selesai</b> {{$project->title}} ?','#finish',event)"
                        style="border-width: 2px !important">SELESAI</button>
                </form>
            </div>
            @endif
            <div class="{{$project->partner_finish && Auth::user()->role_id === 2 ? 'col-12' : 'col-6' }}">
                <a href="{{route('chat.room',['project'=>$project->id])}}">
                    <button class="btn btn-outline-primary roundedCorner w-100 font-weight-bold"
                        style="border-width: 2px !important">CHAT</button>
                </a>
            </div>
        </div>
    </div>
</nav>



@endif
