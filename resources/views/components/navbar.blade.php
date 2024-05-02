<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        @if(!\Illuminate\Support\Facades\Auth::check())
            <li class="nav-item ml-3">
                <a href="{{ route("login") }}" class="btn btn-primary text-white text-bold float-right">
                    Login
                </a>
            </li>

        @else
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
            <li class="nav-item dropdown">
                <a style="text-decoration: none" data-toggle="dropdown">
                    <div class="user-panel d-flex" style="margin-top: 2px">
                        <div class="image">
                            @if(auth()->user()->profile_pict == null)
                                <img src="{{ asset('src/img/default-profile-pict.png') }}" class="img-circle custom-border" alt="User Image">
                            @else
                                <img src="{{ asset(auth()->user()->profile_pict) }}" class="img-circle custom-border" alt="User Image">
                            @endif
                        </div>
                        <div type="button" class="info">
                            <span class="d-block">{{ auth()->user()->name }}</span>
                        </div>
                    </div>
                </a>

                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="{{ route('profile') }}" class="dropdown-item">
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

{{--<script>--}}
{{--    document.addEventListener('DOMContentLoaded', function() {--}}
{{--        var navLinks = document.querySelectorAll('.nav-link');--}}
{{--        navLinks.forEach(function(navLink) {--}}
{{--            navLink.addEventListener('click', function() {--}}
{{--                document.getElementById('announcementCounter').style.display = 'none';--}}
{{--            });--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}
