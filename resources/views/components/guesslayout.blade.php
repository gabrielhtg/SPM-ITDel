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
    @foreach($guestHero as $hero)
      <section id="hero" class="d-flex align-items-center justify-content-center" style="background: url('{{ asset('src/walpeper/' . $hero->gambarhero) }}') top center; background-size: cover; position: relative;">
          <div class="container" data-aos="fade-up">
      
            <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
              <div class="col-xl-6 col-lg-8">
                <h1 class="fade-in">{!! $hero->judulhero !!}</h1>
                <h2 class="fade-in" style="animation-delay: 0.5s;">{!! $hero->tambahanhero !!}</h2>
              </div>
            </div>
          </div>
        </section><!-- End Hero -->
    @endforeach

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

    {{-- @isset($dashboard) --}}
    <section class="p-5">
      <div class="container p-3">
          @forelse ($guestIntroduction as $item)
          <h1 id="keteranganContainer" class="mb-3">{{ $item->juduldashboard }}</h1>
            {{-- <hr class="mx-2" style="border-top: 3px solid black; width: 15%;"> --}}
            <div class="p-3 rounded border custom-font-size">
                {!! $item->keterangandashboard !!}
              <div class="row mt-5 justify-content-center">
                <div class="col-md-3">
                  <div class="p-5 rounded bg-light d-flex justify-content-around align-items-center counter-wrapper fadeIn">
                    <div class="fa-3x fas fa-chalkboard-teacher mb-2 counter-icon"></div>
                    <div class="text-center ">
                      <div id="teacherCount" class="counter">0</div>
                      <div class="counter-label fade-in">Mahasiswa</div> <!-- Perbesar font size untuk label -->
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="p-5 rounded bg-light d-flex justify-content-around align-items-center counter-wrapper fadeIn">
                    <div class="fa-3x fas fa-user mb-2 counter-icon"></div>
                    <div class="text-center ">
                      <div id="memberCount" class="counter">0</div>
                      <div class="counter-label fade-in">Dosen</div> <!-- Perbesar font size untuk label -->
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="p-5 rounded bg-light d-flex justify-content-around align-items-center counter-wrapper fadeIn">
                    <div class="fa-3x fas fa-building mb-2 counter-icon"></div>
                    <div class="text-center ">
                      <div id="facultyCount" class="counter">0</div>
                      <div class="counter-label fade-in">Fakultas</div> <!-- Perbesar font size untuk label -->
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="p-5 rounded bg-light d-flex justify-content-around align-items-center counter-wrapper fadeIn">
                    <div class="fa-3x fas fa-graduation-cap mb-2 counter-icon"></div>
                    <div class="text-center" style="padding-bottom:8px">
                      <div id="departmentCount" class="counter">0</div>
                      <div class="counter-label fade-in" style="font-size: 18px ">Program Studi</div> <!-- Perbesar font size untuk label -->
                    </div>
                  </div>
                </div>
              </div>

                

            </div>
            @empty
            <p>No data available.</p>
          @endforelse
                      
          
        </div>
      </section>
    {{-- @endisset --}}
      
    <section id="news-view1" class="">
      <div class="container" data-aos="fade-up">
        <div class="col-sm-6">
          <h1 class="ml-1">Berita SPM IT Del</h1>
          {{-- <a href="#">selengkapnya</a> --}}
      </div>
      <div class="container-fluid py-2">
        <div class="container py-5 border rounded">
          @if(!empty($guestBigNews->gambar))
            <div class="row g-4">
                <div class="col-lg-5 col-xl-7 mt-0">
                    <div class="position-relative overflow-hidden rounded">
                      
                        <img src="{{ asset('src/gambarnews/'.$guestBigNews->gambar) }}" class="img-fluid rounded img-zoomin w-100" style="width: 200px; height: 500px;" alt="">

                    </div>
                    <div class="px-3">
                        <p class="mt-3 fst-italic">
                          {{ $guestBigNews->created_at->format('Y-m-d') }}
                        </p>
                        <a href="{{ route('news-layout-user', ['id' => $guestBigNews->id]) }}" class="text-dark mb-0 link-hover">
                          <h2>{{ $guestBigNews->judul }}</h2>
                        </a>
                        
                        <p class="text-justify">
                          @if (str_word_count($guestBigNews->isinews) > 60)
                              {!! substr($guestBigNews->isinews, 0, 500) !!} ...
                          @else
                              {!! $guestBigNews->isinews !!}
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
                                        <div class="overflow-hidden rounded m-1" style="height: 100px; /* Sesuaikan dengan tinggi yang diinginkan */">
                                          <img src="{{ asset('src/gambarnews/'.$e->gambar) }}" class="img-zoomin img-fluid rounded w-100" style="object-fit: cover;" alt="">
                                        </div>
                                          {{-- <div class="overflow-hidden rounded">
                                              <img src="{{ asset('src/gambarnews/'.$e->gambar) }}" class="img-zoomin img-fluid rounded w-100" alt="">
                                          </div> --}}
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
                      <div class="text-end" style="margin:20px;">
                        <a type="button" class="btn btn-primary" href="{{ route('newspage') }}">See more...</a>
                      </div>
                      
                </div>
            </div>
        </div>
        @else
        <div class="text-center">
          <h1>Berita Tidak Tersedia</h1>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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

<script>
function animateValue(id, start, end, duration) {
    var range = end - start;
    var current = start;
    var increment = end > start ? 1 : -1;
    var stepTime = Math.abs(Math.floor(duration / range));
    var obj = document.getElementById(id);
    var timer = setInterval(function() {
      current += increment;
      obj.innerHTML = current;
      if (current == end) {
        clearInterval(timer);
      }
    }, stepTime);
  }

  function startCounters() {
    animateValue("teacherCount", 0, 1500, 3000);
    animateValue("memberCount", 0, 71, 3000);
    animateValue("facultyCount", 0, 4, 3000);
    animateValue("departmentCount", 0, 9, 3000);
  }

  window.addEventListener('load', startCounters);
</script>
<script>
  $(document).ready(function() {
    var keteranganWidth = $('#keteranganContainer')[0].scrollWidth; // Mengukur lebar konten secara keseluruhan
    $('#keteranganContainer').append('<hr class="my-3" style="border-top: 2px solid black; width: ' + keteranganWidth + 'px;">'); // Menambahkan garis dengan lebar sesuai dengan lebar konten
  });
</script>
</body>
</html>
