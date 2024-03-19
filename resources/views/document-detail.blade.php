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

<section id="hero" class="d-flex align-items-center justify-content-center">
    <div class="container" data-aos="fade-up">
        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
            <div class="col-xl-6 col-lg-8">
                <h1>Document Detail<span></span></h1>
                <h2>disini anda dapat melihat Informasi Mengenai Dokumen</h2>
            </div>
        </div>
    </div>
</section><!-- End Hero -->

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

                            <div class="card-header" style="background-color: #8699ab; padding: 20px;">
                                <h3 class="card-title" style="color: white !important; font-size: 20px; font-weight: bold;">Detail Document</h3>
                            </div>
                            <div class="card-body">
                                <!-- Detail document content -->
                                <table class="table table-responsive">
                                    <tbody>
                                        <tr>
                                            <td class="bold col-2" style="font-size: 20px; font-weight: bold;">Nama Dokumen</td>
                                            <td class="bold" style="font-size: 18px;">{!! strlen($document->name) > 110 ? wordwrap($document->name, 110, "<br>", true) : $document->name !!}</td>
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
                                            <td class="bold" style="font-size: 20px; font-weight: bold;">Nomor</td>
                                            <td class="bold">{{ $document->nomor_dokumen }}</td>
                                        </tr>
                                        <tr>
                                            <td class="bold" style="font-size: 20px; font-weight: bold;">Tahun</td>
                                            <td class="bold">{{ $document->year }}</td>
                                        </tr>
                                        <tr>
                                            <td class="bold" style="font-size: 20px; font-weight: bold;">User Upload</td>
                                            <td class="bold">{{ $uploadedUser->name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="bold" style="font-size: 20px; font-weight: bold;">Created At</td>
                                            <td class="bold">{{ $document->start_date }}</td>
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
                                    <div class="card-header" style="background-color: #8699ab; padding: 20px;">
                                        <h3 class="card-title" style="color: white !important; font-size: 20px; font-weight: bold;">Preview Document</h3>
                                    </div>
                                    <div class="card-body flex-grow-1 text-center">
                                        <!-- Isi preview document -->
                                        <div class="row mb-4">
                                            <div class="col fw-semibold">
                                                <div x-on:click="$store.page.preview(153567, 'database')" class="preview-pdf" data-file-id="153567" style="font-size: 18px; color: #8699ab; font-weight: 500; cursor: pointer;">
                                                    {{ $document->nama_dokumen }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-auto">
                                                @if($document->can_see_by == 1)
                                                    <a class="download-file btn btn-primary" data-label="UU No. 11 Tahun 2020" data-kategori="Peraturan" data-id="153567" href="{{ asset($document->directory) }}" target="_blank" style="width: 150px; height: 40px; font-size: 1rem; background-color: #8699ab; border-radius: 15px; margin: 10px 0; border: none;">
                                                        <i class="fas fa-eye"></i> Preview
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="col-auto">
                                                @if($document->can_see_by == 1)
                                                    <a class="download-file btn btn-primary" data-label="UU No. 11 Tahun 2020" data-kategori="Peraturan" data-id="153567" href="{{ asset($document->directory) }}" download style="width: 150px; height: 40px; font-size: 1rem; background-color: #8699ab; border-radius: 15px; margin: 10px 0; border: none;">
                                                        <i class="fas fa-file-download"></i> Download
                                                    </a>
                                                @endif
                                            </div>                                            
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
                                    <div class="card-header" style="background-color: #8699ab; padding: 20px;">
                                        <h3 class="card-title" style="color: white !important; font-size: 20px; font-weight: bold;">Update Status</h3>
                                    </div>
                                    <div class="card-body flex-grow-1">
                                        <!-- Isi similar document -->
                                        <div class="row justify-content-center mb-4">
                                            <div class="col fw-semibold text-center">
                                                <h4>Dokumen yang digantikan:</h4>
                                                @if($document->menggantikan_dokumen)
                                                    @foreach(explode(',', $document->menggantikan_dokumen) as $menggantikan_id)
                                                        @php
                                                            $dokumenDigantikan = \App\Models\DocumentModel::find($menggantikan_id);
                                                        @endphp
                                                        @if($dokumenDigantikan)
                                                            <p><a href="{{ route('document-detail', ['id' => $dokumenDigantikan->id]) }}">{{ $dokumenDigantikan->name }}</a></p>
                                                        @endif
                                                    @endforeach
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