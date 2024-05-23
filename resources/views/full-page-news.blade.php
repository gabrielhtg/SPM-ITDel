<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita</title>
    <link rel="shortcut icon" type="image/jpg" href="{{ asset('src/img/logo.png') }}"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('src/css/style.css') }}">
    <style>
        /* table, th, td {
            border: 1px solid black;
        } */
        
        .img-container {
            height: 150px;
            width: 100%;
            max-width: 200px;
            margin: auto;
        }

        .img-container img {
            object-fit: cover;
            height: 100%;
            width: 100%;
        }

        @media (max-width: 768px) {
            .table-responsive > .table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            .table td, .table th {
                white-space: normal;
                word-wrap: break-word;
                display: block;
                width: 100%;
                box-sizing: border-box;
            }
        }
    </style>
</head>
<body>
    @include('components.guessnavbar')

    <section>
        <div class="headernewsdetail mb-4" style=" height: 120px; width: 100; background-color:black;"></div>
    </section>

    <section id="news-view" style="min-height: 83vh;">
        <div class="container-fluid py-2">
            <div class="container py-5 border rounded">
                <div class="container" data-aos="fade-up">
                    <div class="container mt-5">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <form class="form-inline">
                                    <input id="searchInput" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" style="width: 100%; height: 80px; border: 2px solid #00000a;">
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <h1 class="ml-1 mt-5">Berita AMI IT Del</h1>
                    </div>

                    <div class="container mt-4">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="d-none d-md-table-header-group">
                                    <tr>
                                        <th>Image</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($news as $e)
                                        <tr>
                                            <td class="align-middle">
                                                <div class="img-container overflow-hidden rounded m-3">
                                                    <img src="{{ asset('src/gambarnews/'.$e->bgimage) }}" class="img-fluid rounded" alt="">
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <div class="p-3">  
                                                    <div class="features-content d-flex flex-column">
                                                        <a href="{{ route('news-layout-user', ['id' => $e->id]) }}" class="h3 font-weight-bold">{{ $e->title }}</a>
                                                        <small><i>
                                                            {{ \Carbon\Carbon::parse($e->start_date)->format('d/m/Y') }}
                                                            @if($e->end_date != null)
                                                                - {{ \Carbon\Carbon::parse($e->end_date)->format('d/m/Y') }}
                                                            @else
                                                                - Sekarang
                                                            @endif
                                                        </i></small>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <hr>
    @include('components.footer')
  
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
    <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('splide/dist/js/splide.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Function to perform search
            function performSearch() {
                var searchText = $('#searchInput').val().toLowerCase();

                // Loop through all table rows
                $('#news-view table tbody tr').each(function() {
                    var found = false;

                    // Check if the search text matches the news title
                    $(this).find('a').each(function() {
                        var titleText = $(this).text().toLowerCase();
                        if (titleText.includes(searchText)) {
                            found = true;
                            return false; // Break the loop if found
                        }
                    });

                    // Show or hide the row based on the search result
                    if (found) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }

            // Listen for form submission
            $('#searchInput').closest('form').on('submit', function(event) {
                event.preventDefault(); // Prevent form submission
                performSearch(); // Perform search
            });

            // Listen for keyup event
            $('#searchInput').on('keyup', function() {
                performSearch(); // Perform search
            });
        });
    </script>
</body>
</html>
