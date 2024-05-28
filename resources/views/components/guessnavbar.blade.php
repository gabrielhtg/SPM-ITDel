@php
    if (\Illuminate\Support\Facades\Auth::check()) {
        \App\Models\User::where('id', \Illuminate\Support\Facades\Auth::user()->id)->update([
            'status' => true,
        ]);
    }

    // Check if the current route is a document route
    $isDocumentRoute = request()->routeIs('getdocument') || request()->routeIs('getdocumentspm') || request()->routeIs('documentManagementAll');

@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Gp Bootstrap Template - Index</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('src/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('src/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('src/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('src/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('src/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('src/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('src/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('src/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('src/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('src/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <header id="header" class="fixed-top ">
        <div class="container d-flex align-items-center justify-content-lg-between">
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo me-auto me-lg-0"><img src="asset/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li>
                        <a id="home-link" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <span class="brand-text display-7">Beranda</span>
                        </a>
                    </li>
                    <li class="col">
                        <a id="tentang-link" href="#tentang" class="nav-link {{ request()->routeIs('tentang') ? 'active' : '' }}" onclick="redirectToTentangView()">
                            Tentang
                        </a>
                    </li>
                    <li class="col">
                        <a id="akreditasi-link" href="#akreditasi" class="nav-link {{ request()->routeIs('akreditasi') ? 'active' : '' }}" onclick="redirectToAkreditasiView()">
                            Akreditasi
                        </a>
                    </li>
                    <li class="col">
                        <a id="news-link" href="#news-view" class="nav-link {{ request()->routeIs('news') ? 'active' : '' }}" onclick="redirectToNewsView()">
                            Berita
                        </a>
                    </li>

                    @if (\Illuminate\Support\Facades\Auth::check())
                        <li class="nav-item">
                            <a href="{{ route('user-settings') }}" class="nav-link">
                                <i class="fas fa-users nav-icon"></i>
                                Users Settings
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('announcement') }}" class="nav-link">
                                <i class="nav-icon fas fa-bell"></i>
                                Announcement
                            </a>
                        </li>
                    @endif

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ $isDocumentRoute ? 'active' : '' }}" 
                        href="#" id="navbarDropdownDokumen" role="button" data-bs-toggle="dropdown" 
                        aria-expanded="false">
                            Dokumen
                        </a>
                        <ul class="dropdown-menu dropdown-menu-sm" aria-labelledby="navbarDropdownDokumen">
                            <li><a class="dropdown-item" href="{{ route('getdocument') }}">Dokumen</a></li>
                            <li><a class="dropdown-item" href="{{ route('getdocumentspm') }}">Dokumen SPM</a></li>
                        </ul>
                    </li>

                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

            @if (!\Illuminate\Support\Facades\Auth::check())
                <a href="{{ route('login') }}" class="btn m-4 get-started-btn scrollto">
                    Login
                </a>
            @else
                <li class="nav-item dropdown">
                    <a style="text-decoration: none" data-toggle="dropdown">
                        <div class="user-panel d-flex" style="margin-top: 2px">
                            <div class="image">
                                @if (auth()->user()->profile_pict == null)
                                    <img src="{{ asset('src/img/default-profile-pict.png') }}"
                                        class="img-circle custom-border" alt="User Image">
                                @else
                                    <img src="{{ asset(auth()->user()->profile_pict) }}"
                                        class="img-circle custom-border" alt="User Image">
                                @endif
                            </div>
                            <div type="button" class="info">
                                <span class="d-block">{{ auth()->user()->name }}</span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="{{ route('edit-profile') }}" class="dropdown-item">
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
        </div>
    </header>
</body>

</html>

<!-- Vendor JS Files -->
<script src="{{ asset('src/vendor/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('src/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('src/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('src/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('src/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('src/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('src/vendor/php-email-form/validate.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ asset('src/js/main.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach(function(navLink) {
            navLink.addEventListener('click', function() {
                document.getElementById('announcementCounter').style.display = 'none';
            });
        });
    });

    function redirectToNewsView() {
        window.location.href = "{{ route('dashboard') }}#news-view1";
        $(document).ready(function() {
            if (window.location.hash === '#news-view1') {
                $('html, body').animate({
                    scrollTop: $("#news-view").offset().top
                }, 2000);
            }
        });
    }

    function redirectToAkreditasiView() {
        window.location.href = "{{ route('dashboard') }}#akreditasi1";
        $(document).ready(function() {
            if (window.location.hash === '#akreditasi1') {
                $('html, body').animate({
                    scrollTop: $("#akreditasi").offset().top
                }, 2000);
            }
        });
    }

    function redirectToTentangView() {
        window.location.href = "{{ route('dashboard') }}#tentang1";
        $(document).ready(function() {
            if (window.location.hash === '#tentang1') {
                $('html, body').animate({
                    scrollTop: $("#tentang").offset().top
                }, 2000);
            }
        });
    }
</script>
