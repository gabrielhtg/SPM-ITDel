@php use App\Services\AllServices;use Illuminate\Support\Facades\Auth; @endphp
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        @if(!Auth::check())
            <li class="nav-item ml-3">
                <a href="{{ route("login") }}" class="btn btn-primary text-white text-bold float-right">
                    Login
                </a>
            </li>
        @else

            {{--        @php--}}
            {{--            $banyakDatalaporan = app(\App\Services\AllServices::class)->countWaitingLaporan(--}}
            {{--                auth()->user()->id,--}}
            {{--            );--}}
            {{--            $allServices = app(\App\Services\AllServices::class);--}}
            {{--            $pendingNotifications = $allServices->getPendingLaporanNotifications();--}}
            {{--            $banyakData = count($pendingNotifications);--}}
            {{--        @endphp--}}

        @php
            $banyakUnreadNotification = AllServices::countNotClickedNotification();
            $notifications = AllServices::getAllNotifications();
        @endphp

            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown">
                    <i class="far fa-bell"></i>
                    @if($banyakUnreadNotification != 0)
                        <span
                            class="badge badge-warning navbar-badge">{{ $banyakUnreadNotification }}</span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right" >
                    <span class="dropdown-header">{{ $banyakUnreadNotification }} Unread Notifications</span>
                    <div class="dropdown-divider"></div>
                        @foreach($notifications as $notification)
                        <form action="{{ route('openNotification') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $notification->id }}">
                            <button type="submit" class="d-flex dropdown-item w-100">
                               @if($notification->clicked)
                                    <i class="far fa-circle nav-icon mr-2 mt-1"></i>
                                    <div class="w-100 d-flex flex-column" style="white-space: normal">
                                        {{ $notification->message }}
                                        <span class="text-muted text-sm">{{ AllServices::getNotificationTime($notification->created_at) }}</span>
                                    </div>
                               @else
                                   <i class="fas fa-exclamation-circle mt-1 mr-2"></i>
                                <div class="w-100 d-flex flex-column" style="white-space: normal">
                                    <strong>{{ $notification->message }}</strong>
                                    <span class="text-muted text-sm">{{ AllServices::getNotificationTime($notification->created_at) }}</span>
                                </div>
                               @endif
                            </button>
                        </form>
                        @endforeach
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>

            {{--          <li class="nav-item dropdown">--}}
            {{--            <a class="nav-link" data-toggle="dropdown" href="#">--}}
            {{--                <i class="far fa-bell"></i>--}}
            {{--                @if ($banyakData >=0 )--}}
            {{--                <span class="badge badge-warning navbar-badge">{{ $banyakDatalaporan }}</span>--}}
            {{--                @else--}}
            {{--                <span class="badge badge-warning navbar-badge"></span>--}}
            {{--                @endif--}}
            {{--            </a>--}}

            {{--            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="min-width: max-content;">--}}
            {{--                <span class="dropdown-item dropdown-header">{{ $banyakDatalaporan}} Pemberitahuan</span>--}}
            {{--                <div class="dropdown-divider"></div>--}}
            {{--                @foreach ($pendingNotifications as $notification)--}}
            {{--                @php--}}
            {{--                $idPembuatLaporan = $notification['laporan']->created_by;--}}

            {{--                @endphp--}}
            {{--                    @if((app(AllServices::class)->isAccountableToRoleLaporan(auth()->user()->role,app(AllServices::class)->getUserRoleById($idPembuatLaporan))))--}}
            {{--                <a href="{{ route('LaporanManagementReject') }}" class="dropdown-item">--}}
            {{--                    <i class="fas fa-envelope mr-2"></i> {{ $notification['notification_text'] }}--}}

            {{--                </a>--}}
            {{--                @endif--}}
            {{--                @endforeach--}}
            {{--                <div class="dropdown-divider"></div>--}}
            {{--                <div class="dropdown-divider"></div>--}}
            {{--                <div class="dropdown-divider"></div>--}}
            {{--            </div>--}}
            {{--        </li>--}}

            <li class="nav-item dropdown">
                <a style="text-decoration: none" data-toggle="dropdown">
                    <div class="user-panel d-flex" style="margin-top: 2px">
                        <div class="image">
                            @if(auth()->user()->profile_pict == null)
                                <img src="{{ asset('src/img/default-profile-pict.png') }}"
                                     class="img-circle custom-border" alt="User Image">
                            @else
                                <img src="{{ asset(auth()->user()->profile_pict) }}" class="img-circle custom-border"
                                     alt="User Image">
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
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
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
