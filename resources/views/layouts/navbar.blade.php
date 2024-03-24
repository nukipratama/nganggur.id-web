<nav class="navbar fixed-bottom navbar-light bg-white shadow-lg p-0 pt-2 m-0 border-top border-gray">
    <div class="container">
        <div class="row justify-content-center align-items-center" style="width:100vw">
            <div class="col text-center mx-1 p-0">
                <a href="{{route('home')}}" style="text-decoration:none">
                    <h2 class="material-icons {{Route::currentRouteName() === 'home' ? 'text-primary' : 'text-secondary'}}"
                        style="font-size:25pt">home
                    </h2>
                    <br>
                </a>
            </div>
            <div class="col text-center mx-1 p-0">
                <a href="{{route('chat.index')}}" style="text-decoration:none">
                    <h2 class="material-icons {{Route::currentRouteName() === 'chat.index' ? 'text-primary' : 'text-secondary'}}"
                        style="font-size:25pt">chat
                    </h2><span id="chatvisibility"
                        class="dot sec counter counter-lg vis text-white font-weight-bold"></span>
                    <br>
                </a>
            </div>
            @if (Auth::user()->role_id !== 2)
            <div class="col-3 text-center p-0">
                <a href="{{route('project.create')}}" style="text-decoration:none">
                    <h2 class="material-icons" style="font-size:40pt">add_circle</h2>
                </a>
            </div>
            @else
            <div class="col text-center p-0">
                <a href="{{route('projects.sorted',['type_title'=>App\Type::select('title')->where('id',Auth::user()->type_id)->first()->title])}}"
                    style="text-decoration:none">
                    <h2 class="material-icons" style="font-size:40pt">search</h2>
                </a>
            </div>
            @endif
            <div class="col text-center mx-1 p-0">
                <a href="{{route('notification.index')}}" style="text-decoration:none">
                    <h2 class="material-icons {{Route::currentRouteName() === 'notification.index' ? 'text-primary' : 'text-secondary'}}"
                        style="font-size:25pt">
                        notifications</h2><span id="badgevisibility"
                        class="dot sec counter counter-lg vis text-white font-weight-bold"></span>
                    <br>
                </a>
            </div>
            <div class="col-2 text-center mx-1 p-0">
                <a href="{{route('account.profile',['user'=>Auth::id()])}}" style="text-decoration:none">
                    <h2 class="material-icons {{Route::currentRouteName() === 'account.profile' ? 'text-primary' : 'text-secondary'}}"
                        style="font-size:25pt">
                        person</h2>
                    <br>
                </a>
            </div>
        </div>
    </div>
</nav>

<script type="module">
    init();

    function request() {
        axios.get('{{route("notification.count")}}')
            .then(function (response) {
                let data = response.data;
                if (data > 0) {
                    $("#badgevisibility").fadeIn(500);
                    if (data < 10) {
                        $("#badgevisibility").html(data)
                    } else {
                        $("#badgevisibility").html('9+')
                    }
                } else {
                    $("#badgevisibility").fadeOut(500);
                }
            })
            .catch(function (error) {
            });
    }

    function chat_count() {
        axios.get('{{route("chat.count")}}')
            .then(function (response) {
                let data = response.data;
                if (data > 0) {
                    $("#chatvisibility").fadeIn(500);
                    if (data < 10) {
                        $("#chatvisibility").html(data)
                    } else {
                        $("#chatvisibility").html('9+')
                    }
                } else {
                    $("#chatvisibility").fadeOut(500);
                }
            })
            .catch(function (error) {
            });
    }

    function init() {
        $("#badgevisibility").hide();
        $("#chatvisibility").hide();
        request();
        chat_count();
        setInterval(function () {
            request();
            chat_count();
        }, 5000);
    }
</script>
