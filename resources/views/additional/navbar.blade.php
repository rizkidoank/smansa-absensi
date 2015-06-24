<nav id="navbar" class="navbar navbar-default" role="navigation">
    <div class="navbar-header">
        @if(Auth::check())
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        @endif
        <a class="navbar-brand" href="{{url('/')}}"><span class="glyphicon glyphicon-calendar"></span></a>
    </div>

    @if(Auth::check())
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav">
            <li><a href="{{url('/')}}"><span class="glyphicon glyphicon-home"></span> Beranda</a></li>
            <li><a href="{{url('/home/laporan')}}"><span class="glyphicon glyphicon-book"></span> Laporan</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><p id="clock_nav" class="navbar-text"></p></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> {{ Auth::user()['nama']}} <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="{{url('/home/configuration')}}"><span class="glyphicon glyphicon-cog"></span> Pengaturan</a></li>
                    <li><a href="{{url('/auth/logout')}}"><span class="glyphicon glyphicon-log-out"></span> Keluar</a></li>
                </ul>
            </li>
        </ul>
    </div>
    @endif
</nav>