<!-- Logo Header -->
<div class="logo-header">
    <a href="/dashboard" class="logo">
        <img src="../../../assets/img/mim.png" alt="navbar brand" class="navbar-brand">
    </a>
    <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon">
            <i class="fa fa-bars"></i>
        </span>
    </button>
    <button class="topbar-toggler more"><i class="fa fa-ellipsis-v"></i></button>
    <div class="navbar-minimize">
        <button class="btn btn-minimize btn-rounded">
            <i class="fa fa-bars"></i>
        </button>
    </div>
</div>
<!-- End Logo Header -->

<!-- Navbar Header -->
<nav class="navbar navbar-header navbar-expand-lg">
    <div class="container-fluid">
        <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
            <li class="nav-item toggle-nav-search hidden-caret">
                <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false"
                    aria-controls="search-nav">
                    <i class="fa fa-search"></i>
                </a>
            </li>
            <li class="nav-item dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                    <div class="avatar-sm">
                        <img src="../../../assets/img/usermim.jpg" alt="..." class="avatar-img rounded-circle">
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <li>
                        <div class="user-box">
                            <div class="avatar-lg"><img src="../../../assets/img/usermim.jpg" alt="image profile"
                                    class="avatar-img rounded"></div>
                            <div class="u-text">
                                <h4>{{ auth()->user()->username }}</h4>
                                <h6>{{ auth()->user()->email }}</h6>
                                <h4>{{ auth()->user()->departement }}</h4>
                                {{-- @inject('getEmployee', 'App\Models\Employee')
                                {{ $getEmployee->getEmployee(auth()->user()->id) }} --}}
                                {{-- <p class="text-muted">{{ auth()->user()->email }}</p><a href="profile.html"
                                    class="btn btn-rounded btn-danger btn-sm">View Profile</a> --}}
                            </div>
                        </div>
                    </li>
                    <li>
                        {{-- <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Account Setting</a> --}}
                        <div class="dropdown-divider"></div>
                        <form action="/logout" method="POST">
                            @csrf
                            <button class="dropdown-item">Logout</button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<!-- End Navbar -->
