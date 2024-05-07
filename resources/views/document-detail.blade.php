<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


</head>
<body>
    @include("components.guessnavbar")

    @foreach($documenthero as $s)
    {{-- @php
    dd($s->imagehero);
    @endphp --}}
     <section id="hero" class="background-under-navbar d-flex align-items-center justify-content-center" style="background: url('{{ asset('src/img/' . $s->imagehero) }}') top center; background-size: cover; position: relative;">
         <div class="container" data-aos="fade-up">
             <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
                 <div class="col-xl-6 col-lg-8">
                     <h1>{{ $s->titlehero }}</h1>
                     <h2>{{ $s->descriptionhero }}</h2>
                 </div>
             </div>
         </div>
     </section>
 @endforeach

<section>
    <div class="content-wrapper">
        <!-- Main content -->
        <div class="card-body">
            <div class="d-flex mb-4">
                {{-- <div class="w-35px flex-shrink-0 d-none d-sm-block">
                    <i class="bi bi-list-task fs-2 text-primary"></i>
            </div> --}}
            <div class="border-bottom border-gray-300 mb-8"></div>
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card">

                            <div class="card-header" style="background-color: #eeeeee; padding: 20px;">
                                <h3 class="card-title" style="color: black !important; font-size: 20px; font-weight: bold;">Detail Dokumen</h3>
                            </div>
                            <div class="card-body">
                                <!-- Detail document content -->
                                <table class="table table-responsive table-borderless" >
                                    <tbody>
                                         <tr>
                                            <td class="bold" style="font-size: 20px; font-weight: bold;">Nomor Dokumen</td>
                                            <td class="bold">{{ $document->nomor_dokumen }}</td>
                                        </tr>
                                        <tr>
                                            <td class="bold col-2" style="font-size: 20px; font-weight: bold;">Nama Dokumen</td>
                                            <td class="bold" style="font-size: 18px;">{!! strlen($document->name) > 110 ? wordwrap($document->name, 110, "<br>", true) : $document->name !!}</td>
                                        </tr>


                                        <tr>
                                        <tr>
                                            <td class="bold" style="font-size: 20px; font-weight: bold;">Deskripsi</td>
                                            <td class="bold">
                                                {!! strlen($document->deskripsi) > 145 ? wordwrap($document->deskripsi, 145, "<br>", true) : $document->deskripsi !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="bold" style="font-size: 20px; font-weight: bold;">Status</td>
                                            <td class="bold"> @php
                                                if($document->keterangan_status == 0) {
                                                    echo 'Tidak Berlaku';
                                                } else {
                                                    echo 'Berlaku';
                                                }
                                            @endphp</td>
                                        </tr>

                                        <tr>
                                            <td class="bold" style="font-size: 20px; font-weight: bold;">Tipe Dokumen</td>
                                            <td class="bold">
                                                @php
                                                    $jenis_document = $jenis_dokumen->where('id', $document->tipe_dokumen)->first();
                                                @endphp
                                                {{ $jenis_document ? $jenis_document->jenis_dokumen : '' }}
                                            </td>

                                        </tr>


                                        <tr>
                                            <td class="bold" style="font-size: 20px; font-weight: bold;">Tahun</td>
                                            <td class="bold">{{ $document->year }}</td>
                                        </tr>
                                        <tr>
                                            <td class="bold" style="font-size: 20px; font-weight: bold;">Diunggah Oleh</td>
                                            <td class="bold">{{ $uploadedUser->name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="bold" style="font-size: 20px; font-weight: bold;">Tanggal Dibuat</td>
                                            <td class="bold">{{ $document->start_date }}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Card Preview Document and Similar Document (1/4 width each) -->
                    <div class="col-lg-4">
                        <div class="row">
                            <!-- Card Preview Document -->
                            <div class="col-lg-12 mb-4">
                                <div class="card">
                                    <div class="card-header" style="background-color: #eeeeee; padding: 20px;">
                                        <h3 class="card-title" style="color: black !important; font-size: 20px; font-weight: bold;">Lihat Dokumen</h3>
                                    </div>
                                    <div class="card-body flex-grow-1 text-center">
                                        <!-- Isi preview document -->
                                        <div class="row mb-4">
                                            <div class="col fw-semibold">

                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-auto">
                                                @if($document->link && $document->can_see_by == 1)
                                                    <a class="download-file btn btn-primary" href="{{ $document->link }}" target="_blank" style="width: 150px; height: 40px; font-size: 1rem; background-color: #4387ca; border-radius: 15px; margin: 10px 0; border: none;">
                                                        <i class="fas fa-external-link-alt"></i> Buka
                                                    </a>
                                                @elseif($document->directory && $document->can_see_by == 1)
                                                    <a class="download-file btn btn-primary" data-label="UU No. 11 Tahun 2020" data-kategori="Peraturan" data-id="153567" href="{{ asset($document->directory) }}" target="_blank" style="width: 150px; height: 40px; font-size: 1rem; background-color: #4387ca; border-radius: 15px; margin: 10px 0; border: none;">
                                                        <i class="fas fa-eye"></i> Lihat
                                                    </a>
                                                @endif
                                            </div>
                                            @if($document->directory && $document->can_see_by == 1)
                                                <div class="col-auto">
                                                    <a class="download-file btn btn-primary" data-label="UU No. 11 Tahun 2020" data-kategori="Peraturan" data-id="153567" href="{{ asset($document->directory) }}" download style="width: 150px; height: 40px; font-size: 1rem; background-color: #4387ca; border-radius: 15px; margin: 10px 0; border: none;">
                                                        <i class="fas fa-file-download"></i> Unduh
                                                    </a>
                                                </div>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- <div class="col-lg-12 mb-4">
                                <div class="card">
                                    <div class="card-header" style="background-color: #8699ab; padding: 20px;">
                                        <h3 class="card-title" style="color: white !important; font-size: 20px; font-weight: bold;">Similar Document</h3>
                                    </div>
                                    <div class="card-body flex-grow-1">
                                        <!-- Isi similar document -->
                                        <div class="row justify-content-center mb-4">
                                            <div class="col fw-semibold text-center">
                                                <ol class="list-unstyled" style="padding-left: 0.5cm;">

                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header" style="background-color: #eeeeee; padding: 20px;">
                                        <h3 class="card-title" style="color: black !important; font-size: 20px; font-weight: bold;">Dokumen Berkaitan</h3>
                                    </div>
                                    <div class="card-body flex-grow-1">
                                        <!-- Isi similar document -->
                                        <div class="row justify-content-center mb-4">
                                            <div class="col fw-semibold text-center">
                                                @php
                                                    // Mendapatkan dokumen dengan parent yang sama dengan dokumen yang sedang dilihat,
                                                    // tetapi tidak termasuk dokumen yang sedang dilihat
                                                    $similarDocuments = \App\Models\DocumentModel::where('parent', $document->parent)
                                                                        ->where('id', '!=', $document->id)
                                                                        ->get();
                                                    $documentCount = $similarDocuments->count();

                                                @endphp

                                                @if($documentCount > 0)
                                                    <ul style="list-style-type: none; padding-left: 0;"> <!-- Menghapus bullet points dan padding -->
                                                        @foreach($similarDocuments->take(10) as $similarDocument)
                                                            <li><a href="{{ route('document-detail', ['id' => $similarDocument->id]) }}">{{ $similarDocument->name }}</a></li>
                                                            <br> <!-- Menambahkan baris kosong setelah setiap dokumen -->
                                                        @endforeach
                                                    </ul>
                                                    @if($documentCount > 9)
                                                    <a href="{{ route('documentReplaced', ['id' => $document->id]) }}" class="btn btn-primary">Lihat Selengkapnya</a>
                                                    @php

                                                    @endphp

                                                    @endif
                                                @else
                                                    <p>Tidak ada dokumen yang digantikan</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- /.content -->
    </section>
    <!-- /.content-wrapper -->

    <!-- jQuery and Bootstrap JS libraries -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
@include('components.footer')
</html>
