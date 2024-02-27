<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .card-title {
            overflow-wrap: break-word;
            color: #087cfc; /* Ubah warna judul kartu */
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #f8f9fa; /* Ubah warna latar belakang footer sesuai kebutuhan */
            text-align: center;
        }
    </style>
</head>
<body style="margin: -10px  py-3;"  >
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container">
        @include("components.guessnavbar")
    </div>
</nav>

<section>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form class="form-inline">
                    <input class="form-control mr-sm-2 flex-grow-1" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </div>
    </div>
</section>

<div class="container mt-5">
    <div class="row">
        @foreach($documents as $e)
            @php
                $accessor = explode(";", $e->give_access_to);
                $documentTitle = strlen($e->name) > 75 ? wordwrap($e->name, 75, "<br>", true) : $e->name;
            @endphp
            @if(in_array(0, $accessor))
                <div class="col-lg-6 mb-4"> <!-- Menggunakan col-lg-6 untuk membuat 2 kolom di dalam col-lg-8 -->
                    <div class="card h-100">
                        <div class="card-header">
                            <h2 class="card-title">{!! $documentTitle !!}</h2>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Tipe: {{$e->tipe_dokumen}} | User Upload: {{ $uploadedUsers->where('id', $e->created_by)->first()->name }}</p>
                            <a href="{{ route('viewdocumentdetail', ['id' => $e->id]) }}" class="btn btn-primary">View Detail</a>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>

<div class="container mt-5">
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-end">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
            </li>
            <li class="page-item active" aria-current="page">
                <a class="page-link" href="#">1</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>
</div>

<footer class="footer py-3">
    @include('components.footer')
</footer>

<!-- jQuery and Bootstrap JS libraries -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
