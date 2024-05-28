<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SPM IT Del</title>
<link rel="shortcut icon" type="image/jpg" href="{{ asset("src/img/logo.png") }}"/>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset("plugins/fontawesome-free/css/all.min.css") }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
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
    <link rel="stylesheet" href="{{ asset("src/css/custom1.css") }}">
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

        .desc-pgh {
          font-size: 15px;
        }
      }

      @media (max-width: 800px) { 
        .desc-pgh {
          font-size: 10px;
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
                <div class="col-xl-6 col-lg-8 d-flex align-items-center justify-content-center">
                  <img src="{{ asset('src/profilhero/' . $hero->profilhero) }}"  class="fade-in"  style="width: 220px; height: 220px;">
                  <div>
                      <h1 class="fade-in" style="animation-delay: 0.5s;">{!! $hero->judulhero !!}</h1>
                      <h2 class="fade-in tambahan" style="animation-delay: 0.5s;margin-left:22px;">{!! $hero->tambahanhero !!}</h2>
                  </div>
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
        </div>
    </div>

    
    {{-- Tentang ITDel --}}
    <section id="tentang1" class="p-md-5">
      <div class="container p-3">
          @forelse ($guestIntroduction as $item)
          <h1 id="keteranganContainer" class="mb-3">{{ $item->juduldashboard }}</h1>
            
            <div class="p-3 rounded custom-font-size">
              <div class="text-justify textketerangandashboard">
                {!! $item->keterangandashboard !!}
              </div>
              <div class="row mt-5 justify-content-center">
                
              </div>
            </div>
            @empty
            <p>No data available.</p>
          @endforelse
        </div>
      </section>


      {{-- Akreditasi----------------------------------------------------------------------------------------------}}
      <section id ="akreditasi1" class="p-md-5" style="margin-top:-80px;">
        <div class="container p-3">
            @forelse ($akreditasi as $item)
            <h1 id="keteranganContainer1" class="mb-3">{{ $item->judulakreditasi }}</h1>
              {{-- <hr class="mx-2" style="border-top: 3px solid black; width: 15%;"> --}}
              <div class="p-3 rounded custom-font-size">
                <div class="row mt-5 justify-content-center">
                  <img src="{{ asset('src/gambarakreditasi/' . $item->gambarakreditasi) }}" class="fade-in" style="width: 1020px; height: 705px; object-fit: cover;">
                </div>
              
                <div class="text-justify textketeranganakreditasi" style="margin-top:35px;font-size:18px;">
                  {!! $item->keteranganakreditasi !!}
                </div>
              </div>
              @empty
              <p>No data available.</p>
            @endforelse
          </div>
        </section>
    {{-- @endisset --}}

    <section id="news-view1" class="p-md-5">
      <div class="container p-4">
        <h1 class="mb-3">Berita SPM IT Del</h1>
        <div class=" rounded p-3">

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
                        @php
                          $description = $e->description;
                          $cleanDesc = strip_tags($description, '<p><b>');
                        @endphp
                        <div class="desc-card card-text desc-pgh">
                            @if (str_word_count($cleanDesc) > 10)
                              {!! substr($cleanDesc, 0, 125) !!} ...
                            @else
                              {!! $cleanDesc !!}
                            @endif
                        </div>
                        <a href="{{ route('news-layout-user', ['id' => $e->id]) }}" class="see-more btn btn-primary text-center" style="position: absolute; bottom: 10px; right:10px">Lihat Detail</a>
                    </div>
                  </div>
                </div>

              @endif
            @empty

            @endforelse

          </div>

          <div class="text-end">
            <a type="button" class="btn btn-primary" href="{{ route('newspage') }}">Lihat Semua Berita</a>
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



</script>
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
<!-- daterangepicker -->
<script src="{{ asset("plugins/moment/moment.min.js") }}"></script>
<script src="{{ asset("plugins/daterangepicker/daterangepicker.js") }}"></script>
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
    document.addEventListener('DOMContentLoaded', function() {
        var splideElement = document.querySelector('.splide');
        if (splideElement) {
            var splide = new Splide('.splide', {
                type: 'loop',
                perPage: 3,
                perMove: 1,
                gap: 20,
                breakpoints: {
                    640: {
                        perPage: 1,
                    },
                },
            });
            splide.mount();
        } else {
            // 
        }
    });
</script>

<script>
  $(document).ready(function() {
    var keteranganWidth = $('#keteranganContainer')[0].scrollWidth; // Mengukur lebar konten secara keseluruhan
    $('#keteranganContainer').append('<hr class="my-3" style="border-top: 2px solid black; width: ' + keteranganWidth + 'px;">'); // Menambahkan garis dengan lebar sesuai dengan lebar konten
  });

  $(document).ready(function() {
    var keteranganWidth = $('#keteranganContainer1')[0].scrollWidth; // Mengukur lebar konten secara keseluruhan
    $('#keteranganContainer1').append('<hr class="my-3" style="border-top: 2px solid black; width: ' + keteranganWidth + 'px;">'); // Menambahkan garis dengan lebar sesuai dengan lebar konten
  });
</script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const sections = document.querySelectorAll('section');
    const navLinks = document.querySelectorAll('.nav-link');

    function updateActiveLink() {
      let index = sections.length;

      while(--index && window.scrollY + 50 < sections[index].offsetTop) {}

      navLinks.forEach((link) => link.classList.remove('active'));
      navLinks[index].classList.add('active');
    }

    window.addEventListener('scroll', updateActiveLink);
  });
</script>
</body>
</html>
