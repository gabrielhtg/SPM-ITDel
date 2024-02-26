<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Bell -->
        <li class="nav-item">
            <a class="nav-link" data-toggle="modal" href="#notificationsModal">
                @if(count($newAnnouncement) > 0)
                    <i class="far fa-bell"></i>
                    <span id="announcementCounter" class="badge badge-warning navbar-badge">
                        {{ count($newAnnouncement) }}
                    </span>
                @endif
            </a>
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

<!-- Modal -->
<div class="modal fade" id="notificationsModal" tabindex="-1" aria-labelledby="notificationsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notificationsModalLabel">Announcement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group list-group-flush">
                    @forelse ($newAnnouncement as $item)
                    <li class="list-group-item">
                        <a href="{{ route('announcement.detail', ['id' => $item->id]) }}" class="text-dark font-weight-bold">{{ $item->title }}</a>
                    </li>
                    @empty
                    <li class="list-group-item">
                        <a href="" class="text-dark font-weight-bold">Belum ada data pengumuman</a>
                    </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach(function(navLink) {
            navLink.addEventListener('click', function() {
                document.getElementById('announcementCounter').style.display = 'none';
            });
        });
    });
</script>
