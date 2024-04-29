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

    <style>
      .desc-card {
        font-size: 15px;
      }

      .see-more {
        position: absolute; 
        bottom: 10px; 
        right:10px;
      }

      @media (max-width: 1400px) {
        .title-card {
          font-size: 13px; /* Ubah ukuran font judul saat lebar layar kurang dari atau sama dengan 576px */
        }
        
        .desc-card {
          font-size: 10px; /* Ubah ukuran font deskripsi saat lebar layar kurang dari atau sama dengan 576px */
        }

        .time-card {
          font-size: 10px;
        }

        .see-more.btn {
          font-size: 15px;
        }
      }

      @media (max-width: 576px) {
        .title-card {
          font-size: 13px;
        }
        
        .desc-card {
          font-size: 10px; 
        }

        .time-card {
          font-size: 10px
        }

        .see-more.btn {
          font-size: 10px;
        }
      }
    </style>

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

    <section id="news-view1" class="p-5">
      <div class="container p-4">
        <h1 class="mb-3">Berita SPM IT Del</h1>
        <div class="border rounded p-3">

          <div class="row">

            @forelse($news as $e)
              @if($e->keterangan_status == 1)

                <div class="col-sm-6 ">
                  <div class="card" style="max-height: 390px; min-height: 390px; position: relative;">
                    <img src="{{ asset('src/gambarnews/'.$e->bgimage) }}" class="card-img-top img-fluid" alt="..." style="object-fit: cover; height: 200px;" loading="lazy">
                    <div class="card-body" style="padding: 10px; position: relative;">
                        <h5 class="title-card card-title mb-1 fw-bold">{{ $e->title }}</h5>
                        <p class="time-card card-text text-secondary mb-1">
                          <i>
                            {{ \Carbon\Carbon::parse($e->start_date)->format('d/m/Y') }}
                            @if($e->end_date != null)
                                - {{ \Carbon\Carbon::parse($e->end_date)->format('d/m/Y') }}
                            @else
                                - Sekarang
                            @endif
                          </i>
                        </p>
                        <p class="desc-card card-text">
                            @php
                                $description = $e->description;
                                // Memeriksa apakah teks mengandung tag <table> atau tag <img>
                                $containsTable = preg_match('/<table\b[^>]>(.?)<\/table>/s', $description);
                                $containsImage = preg_match('/<img\b[^>]*>/', $description);
                            @endphp
                            @if (!$containsTable && !$containsImage && !empty(trim(strip_tags($e->description))))
                                {{-- {!! $e->description !!} --}}
                                @if (str_word_count($e->description) > 10)
                                    {!! substr($e->description, 0, 110) !!} ...
                                @else
                                    {!! $e->description !!}
                                @endif
                            @endif
                        </p>
                        <a href="{{ route('news-layout-user', ['id' => $e->id]) }}" class="see-more btn btn-primary text-center" style="position: absolute; bottom: 10px; right:10px">See more ...</a>
                    </div>
                  </div>
                </div>

              @endif
            @empty

            @endforelse

          </div>

          <div class="text-end">
            <a type="button" class="btn btn-primary" href="{{ route('newspage') }}">View All News</a>
          </div>

        </div>
      </div>
    </section>
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
