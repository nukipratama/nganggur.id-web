<div class="row w-100 m-0 mt-2 py-4  roundedCorner shadow-lg ">
    <div class="container marginBottom">
        <div class="row ">
            <div class="col-12 my-1">
                <h1 class="font-weight-bold d-inline">Pengerjaan</h1>
                @if ($project->partner_id === Auth::id())
                <a href="{{route('project.progress.form',['project'=>$project->id])}}" class="text-dark">
                    <div class="row align-items-center float-right pr-3 ">
                        <span class="material-icons " style="font-size: 25pt">post_add</span>
                        <span class=" font-weight-bold">Unggah Pengerjaan</span>
                    </div>
                </a>
                @endif
            </div>
            @if ($project->partner_finish)
            <div class="col-12">
                <p class="text-justify">
                    <b>{{Auth::id() !== $project->partner_id ? $project->partner->name : 'Anda'}}</b> telah meminta
                    untuk menyelesaikan
                    <b>{{$project->title}}</b>.
                    @if (Auth::id() === $project->user_id)
                    Silahkan pilih tombol Selesai dibawah <b>jika project sudah selesai</b>.
                    Dengan menekan tombol Selesai, <b>{{$project->title}}</b> akan <b>ditandai selesai</b> dan
                    pembayaran proyek akan
                    dikirimkan kepada <b>{{$project->partner->name}}</b>.
                    @endif
                </p>
            </div>
            @endif
            <div class="col-12">
                <ul class="timeline">
                    @foreach ($project->progress as $item)
                    <li style="--timeline-color:{{$item->step !== 0 ? '#DBA66C' : '#3F83E1' }}">
                        <p class=" float-right">{{\Carbon\Carbon::parse($item->created_at)->format('d M Y')}}</p>
                        <h5 class="font-weight-bold d-inline">{{$item->title}}</h5>
                        <p class="my-1 text-break show-read-more">{{$item->description}}</p>
                        @if (isset($item->attachment))
                        @foreach (json_decode($item->attachment) as $attach)
                        <div class="row pl-3 p-1 align-items-center">
                            <span class="material-icons text-secondary">description</span>
                            <a href="{{$attach}}" target="_blank">
                                <span class="text-dark font-weight-bold">{{basename($attach)}}</span>
                            </a>
                        </div>
                        @endforeach
                        @endif
                        @if($project->partner_id === Auth::id() && $item->step !==0 && !$item->verified_at &&
                        !$item->refused_at)
                        <div class="badge badge-light border border-secondary text-secondary">
                            <p class="font-weight-bold d-inline">Belum diverifikasi</p>
                        </div>
                        @endif
                        @if ($item->verified_at)
                        <div class="badge badge-light border border-success text-success">
                            <p class="font-weight-bold d-inline">Pengerjaan Diterima</p>
                        </div>
                        @elseif($item->refused_at)
                        <div class="badge badge-light border border-danger text-danger">
                            <p class="font-weight-bold d-inline">Pengerjaan ditolak</p>
                        </div>
                        @endif
                        @if ($item->step !== 0) @if ($project->user_id === Auth::id() && !$item->verified_at &&
                        !$item->refused_at)
                        <form method="post" class="d-inline" id="verify_{{$item->id}}"
                            action="{{route('project.progress.verify',['project'=>$item->project_id,'progress'=>$item->id])}}">
                            @csrf @method('PUT')
                            <button type="submit" class="p-0 border-0 bg-white"
                                onclick="swal('Apakah anda yakin untuk <b>terima</b> pengerjaan <b>{{$item->title}}</bterima> ?','#verify_{{$item->id}}',event)">
                                <div class="badge badge-success my-1">
                                    <h6 class="fas fa-check-circle d-inline"></h6>
                                    <h6 class="font-weight-bold d-inline">Terima</h6>
                                </div>
                            </button>
                        </form>
                        <form method="post" class="d-inline " id="refuse_{{$item->id}}"
                            action="{{route('project.progress.refuse',['project'=>$item->project_id,'progress'=>$item->id])}}">
                            @csrf @method('PUT')
                            <button type="submit" class="p-0 border-0 bg-white"
                                onclick="swal('Apakah anda yakin untuk <b>menolak</b> pengerjaan <b>{{$item->title}}</b> ?','#refuse_{{$item->id}}',event)">
                                <div class="badge badge-danger my-1">
                                    <h6 class="fas fa-check-circle d-inline"></h6>
                                    <h6 class="font-weight-bold d-inline">Tolak</h6>
                                </div>
                            </button>
                        </form>
                        @endif
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
