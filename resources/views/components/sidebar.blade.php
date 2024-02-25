@php use Illuminate\Support\Facades\Auth; @endphp
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route("dashboard") }}" class="brand-link">
        <img src="{{ asset("src/img/logo.png") }}" alt="Logo" class="brand-image elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><strong>SPM</strong> IT Del</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- SidebarSearch Form -->
        <div class="form-inline mt-3 mb-3">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('news') }}" class="nav-link active">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>
                            News
                        </p>
                    </a>
                </li>
                @if(Auth::check())
                    <li class="nav-item menu-open">
                        <a href="#" class="nav-link">
                            <i class="fas fa-users nav-icon"></i>
                            <p>
                                Users Settings
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('user-settings-active') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Active User</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user-settings-inactive') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Inactive User</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                @endif
                <li class="nav-item">
                    <a href="{{ route('documentManagement') }}" class="nav-link">
                        <i class="fas fa-file nav-icon"></i>
                        <p>
                            Document Management
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('announcement') }}" class="nav-link">
                        <i class="nav-icon fas fa-bell"></i>
                        <p>
                            Announcement
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
