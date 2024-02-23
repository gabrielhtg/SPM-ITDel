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
    
          <div class="row gy-4 mt-5 justify-content-center" data-aos="zoom-in" data-aos-delay="250">
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
          </div>
    
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

    <section id="about" class="about">
      <div class="container" data-aos="fade-up">
        <div class="col-sm-6">
          <h1 class="m-0">Berita AMI ITDel</h1>
          <a href="#">selengkapnya</a>
      </div>
        <section class="content">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-md-6">
                      {{-- Left Column --}}
                      <li class="splide__slide">
                          <img src="https://akcdn.detik.net.id/visual/2024/02/06/jejak-langkah-ganjar-mahfud-md-menuju-pilpres-2024-8_169.jpeg?w=650&q=90" alt="">
                          <div>
                              Ganjar-Mahfud Menang di Satu Provinsi Versi Quick Count Pilpres PRC
                          </div>
                      </li>
                  </div>
                  <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="https://akcdn.detik.net.id/visual/2023/10/31/ilustrasi-tiga-paslon_169.jpeg?w=200&q=90" alt="" class="img-fluid">
                        </div>
                        <div class="col-md-8" style="padding: 20px;">
                            <h6>hari, tanggal</h6>
                            <p>Hasil Akhir Quick Count Semua Provinsi Pulau Jawa Berbagai Lembaga</p>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                          <img src="https://akcdn.detik.net.id/visual/2023/10/31/ilustrasi-tiga-paslon_169.jpeg?w=200&q=90" alt="" class="img-fluid">
                      </div>
                      <div class="col-md-8" style="padding: 20px;">
                          <h6>hari, tanggal</h6>
                          <p>Hasil Akhir Quick Count Semua Provinsi Pulau Jawa Berbagai Lembaga</p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                          <img src="https://akcdn.detik.net.id/visual/2023/10/31/ilustrasi-tiga-paslon_169.jpeg?w=200&q=90" alt="" class="img-fluid">
                      </div>
                      <div class="col-md-8" style="padding: 20px;">
                          <h6>hari, tanggal</h6>
                          <p>Hasil Akhir Quick Count Semua Provinsi Pulau Jawa Berbagai Lembaga</p>
                      </div>
                    </div>
                  </div>
                  </div>
                                  
              </div>
          </div>
      </section>
      </div>
    </section><!-- End About Section -->
    <!-- /.content-wrapper -->
    @include('components.footer')

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
