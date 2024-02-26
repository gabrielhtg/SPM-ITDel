<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SPM IT Del</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset("plugins/fontawesome-free/css/all.min.css") }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset("plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css") }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset("plugins/icheck-bootstrap/icheck-bootstrap.min.css") }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset("plugins/jqvmap/jqvmap.min.css") }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset("dist/css/adminlte.min.css") }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset("plugins/overlayScrollbars/css/OverlayScrollbars.min.css") }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset("plugins/daterangepicker/daterangepicker.css") }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset("plugins/summernote/summernote-bs4.min.css") }}">
    <link rel="stylesheet" href="{{ asset("src/css/custom.css") }}">
    <link rel="stylesheet" href="{{ asset("splide/dist/css/splide.min.css") }}">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{ asset("src/img/logo.png") }}" alt="LogoDel" height="60" width="60">
    </div>
    
    <!-- Navbar -->
    @include("components.guessnavbar")
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    {{-- @include("components.sidebar") --}}
    <section id="hero" class="d-flex align-items-center justify-content-center">
        <div class="container" data-aos="fade-up">
    
          <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
            <div class="col-xl-6 col-lg-8">
              <h1>Selamat Datang Di Website AMI<span></span></h1>
              <h2>disini anda dapat melihat setiap aktivitas kami</h2>
            </div>
          </div>
    
          {{-- <div class="row gy-4 mt-5 justify-content-center" data-aos="zoom-in" data-aos-delay="250">
            <div class="col-xl-2 col-md-4">
              <div class="icon-box">
                <i class="ri-store-line"></i>
                <h3><a href="">Lorem Ipsum</a></h3>
              </div>
            </div>
            <div class="col-xl-2 col-md-4">
              <div class="icon-box">
                <i class="ri-bar-chart-box-line"></i>
                <h3><a href="">Dolor Sitema</a></h3>
              </div>
            </div>
            <div class="col-xl-2 col-md-4">
              <div class="icon-box">
                <i class="ri-calendar-todo-line"></i>
                <h3><a href="">Sedare Perspiciatis</a></h3>
              </div>
            </div>
            <div class="col-xl-2 col-md-4">
              <div class="icon-box">
                <i class="ri-paint-brush-line"></i>
                <h3><a href="">Magni Dolores</a></h3>
              </div>
            </div>
            <div class="col-xl-2 col-md-4">
              <div class="icon-box">
                <i class="ri-database-2-line"></i>
                <h3><a href="">Nemos Enimade</a></h3>
              </div>
            </div>
          </div> --}}
    
        </div>
      </section><!-- End Hero -->

    <!-- Content Wrapper. Contains page content -->
    <div class="container-fluid">
        <div class="content px-5">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            
            
            
            
            <!-- /.content -->
        </div>
    </div>

    <section class="p-5">
      <div class="container p-4">
        <h1 class="mb-3">Tentang AMI IT Del</h1>
        <div class="p-3 rounded border">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima consectetur quis dolorum ipsum accusantium laboriosam reiciendis fugiat est, veniam quod, temporibus consequatur?
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima consectetur quis dolorum ipsum accusantium laboriosam reiciendis fugiat est, veniam quod, temporibus consequatur?
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima consectetur quis dolorum ipsum accusantium laboriosam reiciendis fugiat est, veniam quod, temporibus consequatur?
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima consectetur quis dolorum ipsum accusantium laboriosam reiciendis fugiat est, veniam quod, temporibus consequatur?
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima consectetur quis dolorum ipsum accusantium laboriosam reiciendis fugiat est, veniam quod, temporibus consequatur?
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima consectetur quis dolorum ipsum accusantium laboriosam reiciendis fugiat est, veniam quod, temporibus consequatur?
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima consectetur quis dolorum ipsum accusantium laboriosam reiciendis fugiat est, veniam quod, temporibus consequatur?

          <div class="row mt-5 justify-content-center">
            <div class="col-md-3">
              <div class="p-5 rounded bg-primary d-flex justify-content-around align-items-center">
                <div class="fa-3x fas fa-chalkboard-teacher mb-2"></div>
                <div class="text-center ">
                  <div class="text-bold">18</div>
                  <div>Teachers</div>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="p-5 rounded bg-primary d-flex justify-content-around align-items-center">
                <div class="fa-3x fas fas fa-user mb-2"></div>
                <div class="text-center ">
                  <div class="text-bold">18</div>
                  <div>Members</div>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="p-5 rounded bg-primary d-flex justify-content-around align-items-center">
                <div class="fa-3x fas fas fa-building mb-2"></div>
                <div class="text-center ">
                  <div class="text-bold">18</div>
                  <div>Faculties</div>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="p-5 rounded bg-primary d-flex justify-content-around align-items-center">
                <div class="fa-3x fas fas fa-graduation-cap mb-2"></div>
                <div class="text-center ">
                  <div class="text-bold">18</div>
                  <div>Departements</div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

    <section id="news-view" class="">
      <div class="container" data-aos="fade-up">
        <div class="col-sm-6">
          <h1 class="ml-1">Berita AMI IT Del</h1>
          {{-- <a href="#">selengkapnya</a> --}}
      </div>
      <div class="container-fluid py-2">
        <div class="container py-5 border rounded">
          @if(!empty($guestBigNews->gambar))
            <div class="row g-4">
                <div class="col-lg-5 col-xl-7 mt-0">
                    <div class="position-relative overflow-hidden rounded">
                        <img src="{{ asset('src/gambarnews/'.$guestBigNews->gambar) }}" class="img-fluid rounded img-zoomin w-100" alt="">
                        {{-- <div class="d-flex justify-content-center px-4 position-absolute flex-wrap" style="bottom: 10px; left: 0;">
                            <a href="#" class="text-white me-3 link-hover"><i class="fa fa-clock"></i> 06 minute read</a>
                            <a href="#" class="text-white me-3 link-hover"><i class="fa fa-eye"></i> 3.5k Views</a>
                            <a href="#" class="text-white me-3 link-hover"><i class="fa fa-comment-dots"></i> 05 Comment</a>
                            <a href="#" class="text-white link-hover"><i class="fa fa-arrow-up"></i> 1.5k Share</a>
                        </div> --}}
                    </div>
                    <div class="px-3">
                        <p class="mt-3 fst-italic">
                          {{ $guestBigNews->created_at->format('Y-m-d') }}
                        </p>
                        <a href="#" class="text-dark mb-0 link-hover">
                          <h2>{{ $guestBigNews->judul }}</h2>
                        </a>
                        <p class="text-justify">
                          @if (str_word_count($guestBigNews->isinews) > 60)
                              {!! substr($guestBigNews->isinews, 0, 500) !!} ...
                          @else
                              {{ $guestBigNews->isinews }}
                          @endif
                          {{-- {!! $guestBigNews->isinews !!} --}}
                        </p>
                    </div>
                </div>
                <div class="col-lg-5 col-xl-5">
                   <div class="bg-light rounded p-4 pt-0">
                        <div class="row g-4">
                          @forelse($guestNews as $e)
                            @if ($loop->index != 0)
                              <div class="col-12">
                                  <div class="row g-4 align-items-center">
                                      <div class="col-5">
                                          <div class="overflow-hidden rounded">
                                              <img src="{{ asset('src/gambarnews/'.$e->gambar) }}" class="img-zoomin img-fluid rounded w-100" alt="">
                                          </div>
                                      </div>
                                      <div class="col-7">
                                          <div class="features-content d-flex flex-column">
                                              <a href="#" class="h6 font-weight-bold">{{ $e->judul }}</a>
                                              <small><i class="">{{ $e->created_at->format('Y-m-d') }}</i> </small>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                            @endif
                          @empty
                            {{-- tidak ada data --}}
                          @endforelse
                        </div>
                   </div>
                </div>
            </div>
        </div>
        @else
        <div class="text-center">
          <p>Berita Tidak Tersedia</p>
        </div>
        @endif
      </div>
      </div>
    </section><!-- End About Section -->
    <!-- /.content-wrapper -->
    
    @include('components.guessfooter')
    {{-- Copyright © 2024 Informatika 2021 Kelompok 1. All rights reserved. --}}

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset("plugins/jquery/jquery.min.js") }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset("plugins/jquery-ui/jquery-ui.min.js") }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset("plugins/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
<!-- ChartJS -->
<script src="{{ asset("plugins/chart.js/Chart.min.js") }}"></script>
<!-- Sparkline -->
<script src="{{ asset("plugins/sparklines/sparkline.js") }}"></script>
<!-- JQVMap -->
<script src="{{ asset("plugins/jqvmap/jquery.vmap.min.js") }}"></script>
<script src="{{ asset("plugins/jqvmap/maps/jquery.vmap.usa.js") }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset("plugins/jquery-knob/jquery.knob.min.js") }}"></script>
<!-- daterangepicker -->
<script src="{{ asset("plugins/moment/moment.min.js") }}"></script>
<script src="{{ asset("plugins/daterangepicker/daterangepicker.js") }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset("plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js") }}"></script>
<!-- Summernote -->
<script src="{{ asset("plugins/summernote/summernote-bs4.min.js") }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset("plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js") }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset("dist/js/adminlte.js") }}"></script>
<!-- AdminLTE for demo purposes -->
{{--<script src="{{ asset("dist/js/demo.js") }}"></script>--}}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset("dist/js/pages/dashboard.js") }}"></script>
<script src="{{ asset('splide/dist/js/splide.min.js') }}"></script>
<script>
    var splide = new Splide( '.splide', {
        type   : 'loop',
        perPage: 3,
        perMove: 1,
        gap: 20,
        breakpoints: {
            640: {
                perPage: 1,
            },
        },
    } );

    splide.mount();
</script>
</body>
</html>
