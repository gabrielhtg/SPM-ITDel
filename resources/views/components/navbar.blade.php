@php
    if (\Illuminate\Support\Facades\Auth::check()) {
        \App\Models\User::where('id', \Illuminate\Support\Facades\Auth::user()->id)->update([
            'status' => true
        ]);
    }
@endphp

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> 8 friend requests
                    <span class="float-right text-muted text-sm">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> 3 new reports
                    <span class="float-right text-muted text-sm">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>
        @if(!\Illuminate\Support\Facades\Auth::check())
            <li class="nav-item ml-3">
                <a href="{{ route("login") }}" class="btn btn-primary text-white text-bold float-right">
                    Login
                </a>
            </li>

        @else
            <li class="nav-item dropdown">
                <a style="text-decoration: none" data-toggle="dropdown">
                    <div class="user-panel d-flex" style="margin-top: 2px">
                        <div class="image">
                            <img src="{{ asset(auth()->user()->profile_pict) }}" class="img-circle custom-border" alt="User Image">
                        </div>
                        <div type="button" class="info">
                            <span class="d-block">{{ auth()->user()->name }}</span>
                        </div>
                    </div>
                </a>

                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="#" class="dropdown-item">
                        <i class="mr-2 fas fa-user" style="padding-right: 1px"></i> Profile
                    </a>

                    <div class="dropdown-divider"></div>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="fas fa-sign-out-alt mr-2" ></i> Logout
                        </button>
                    </form>
                </div>
            </li>
        @endif
    </ul>
</nav>
