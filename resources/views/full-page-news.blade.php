<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset("src/css/style.css") }}">
    <style>
        
    </style>
</head>
<body>
  @include("components.guessnavbar")

  <section id="hero" class="d-flex align-items-center justify-content-center">
      <div class="container" data-aos="fade-up">
          <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
              <div class="col-xl-6 col-lg-8">
                  <h1>Berita Detail<span></span></h1>
                  <h2>disini anda dapat melihat Informasi Mengenai Berita</h2>
              </div>
          </div>
      </div>
  </section>

    <section id="news-view" >
      <div class="container-fluid py-2">
        <div class="container py-5 border rounded">
          <div class="container" data-aos="fade-up">
            <form action="/news/page/cari" method="GET">
              @csrf
              <div class="input-group">
                <input type="search" name="carinews" class="form-control form-control-lg" placeholder="Cari berita yang ingin anda temukan disini">
                <div class="input-group-append">
                  <button type="submit" class="btn btn-lg btn-default">
                    <i class="fa fa-search"></i>
                  </button>
                </div>
              </div>
            </form>


            <div class="col-sm-6">
              <h1 class="ml-1 mt-5">Berita AMI IT Del</h1>
            </div>
            {{-- @if(!empty($guestBigNews->gambar)) --}}
            <table >
              <tr>
                <th>
                  {{-- nama --}}
                </th>
                <th>
                  {{-- jabatan --}}
                </th>
              </tr>

              @foreach ($news as $e)
              <tr >
                <th style="vertical-align: center;">
                    <div class="col-5">
                        <div class="overflow-hidden rounded m-3" style="height: 150px; width: 200px; /* Sesuaikan dengan lebar yang diinginkan */">
                            <img src="{{ asset('src/gambarnews/'.$e->gambar) }}" class="img-zoomin img-fluid rounded w-100" style="object-fit: cover;" alt="">
                        </div>
                    </div>
                </th>
                <th style="vertical-align: center; padding-left: 10px; width: 850px">
                    <div class="col-7">
                        <div class="features-content d-flex flex-column">
                            <a href="#" class="h3 font-weight-bold">{{ $e->judul }}</a>
                            <small><i class="">{{ $e->created_at }}</i></small>
                        </div>
                    </div>
                </th>
            </tr>
              @endforeach

            </table>
          </div>
      </div>
      </div>
    </section>
    @include('components.footer')
  
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
    <script>
      // JavaScript untuk menangani efek discroll pada navbar
      document.addEventListener('scroll', function () {
          var header = document.getElementById('header');
          var scrolled = window.scrollY;
  
          // Tambahkan atau hapus class 'header-scrolled' sesuai dengan posisi scroll
          if (scrolled > 100) {
              header.classList.add('header-scrolled');
          } else {
              header.classList.remove('header-scrolled');
          }
      });
  
      // JavaScript untuk menangani navigasi pada versi mobile
      var mobileNavToggle = document.querySelector('.mobile-nav-toggle');
      var navbarMobile = document.querySelector('.navbar-mobile');
  
      mobileNavToggle.addEventListener('click', function () {
          navbarMobile.classList.toggle('active');
      });
  </script>
  
</body>

</html>