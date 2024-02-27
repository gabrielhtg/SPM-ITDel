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
    <body>
        

        <section>
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="card-body">
                <div class="d-flex mb-4">
                    <div class="w-35px flex-shrink-0 d-none d-sm-block">
                        <i class="bi bi-list-task fs-2 text-primary"></i>
                    </div>
                    <div class="flex-grow-1 d-flex justify-content-between" style="background-color: #087cfc; padding: 20px;">
                        <h4 class="text-primary" style="color: white !important;"> Detail <span class="opacity-50">Document</span></h4>
                    </div>
                </div>
                <div class="border-bottom border-gray-300 mb-8"></div>
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <!-- Card Detail Document (3/4 width) -->
                        <div class="col-lg-8">
                            <div class="card">
                                
                                <div class="card-header" style="background-color: #087cfc; padding: 20px;">
                                    <h3 class="card-title" style="color: white !important; font-size: 20px; font-weight: bold;">Detail Document</h3>
                                </div>
                                <div class="card-body">
                                    <!-- Detail document content -->
                                    <table class="table">
                            <tbody>
                                <tr>
                                    <td class="bold col-2" style="font-size: 20px; font-weight: bold;">Nama Dokumen</td>
                                    <td class="bold" style="font-size: 18px;">{!! strlen($document->name) > 110 ? wordwrap($document->name, 110, "<br>", true) : $document->name !!}</td>
                                </tr>
                                <tr>
                                    <td class="bold" style="font-size: 20px; font-weight: bold;">Tipe Dokumen</td>
                                    <td class="bold">{{ $document->tipe_dokumen }}</td>
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
                                    <td class="bold">{{ $document->created_at }}</td>
                                </tr>
                                <tr>
                                    <td class="bold" style="font-size: 20px; font-weight: bold;">Tanggal Berlaku</td>
                                    <td class="bold">{{ $document->expried_date }}</td>
                                </tr>
                                <tr>
                                    <td class="bold" style="font-size: 20px; font-weight: bold;">Status</td>
                                    <td class="bold">{{ $document->status }}</td>
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
                                    <div class="card" style="width: 650px;">
                                        <div class="card-header" style="background-color: #087cfc; padding: 20px;">
                                            <h3 class="card-title" style="color: white !important; font-size: 20px; font-weight: bold;">Preview Document</h3>
                                        </div>
                                        <div class="card-body flex-grow-1 text-center">
                                            <!-- Isi preview document -->
                                            <div class="row mb-4">
                                                <div class="col fw-semibold">
                                                <div x-on:click="$store.page.preview(153567, 'database')" class="preview-pdf" data-file-id="153567" style="font-size: 18px; color: #087cfc; font-weight: 500; cursor: pointer;">
                                                        {{ $document->name }}
                                                </div>

                                                </div>
                                            </div>
                                            <div class="row justify-content-center">
                                                <div class="col-auto">
                                                <a x-on:click="$store.page.preview(153567, 'dedi')" data-file-id="153567" class="download-file btn btn-primary me-1" style="width: 200px; height: 60px; font-size: 1.5rem; background-color: #087cfc; border-radius: 20px;">
                                                    <i class="fas fa-eye"></i> <!-- Menggunakan kelas fas untuk Font Awesome -->
                                                    Preview
                                                </a>
                                                </div>
                                                <div class="col-auto">
                                                    <a class="download-file btn btn-primary" data-label="UU No. 11 Tahun 2020" data-kategori="Peraturan" data-id="153567" href="#" style="width: 200px; height: 60px; font-size: 1.5rem; background-color: #087cfc; border-radius: 20px;">
                                                        <i class="fas fa-file-download"></i> <!-- Menggunakan kelas fas untuk Font Awesome -->
                                                        Download
                                                    </a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
        <div class="card">
            <div class="card-header" style="background-color: #087cfc; padding: 20px;">
                <h3 class="card-title" style="color: white !important; font-size: 20px; font-weight: bold;">Similar Document</h3>
            </div>
            <div class="card-body flex-grow-1">
                <!-- Isi similar document -->
                <div class="row justify-content-center mb-4">
                    <div class="col fw-semibold text-center">
                        <ol class="list-unstyled" style="padding-left: 0.5cm;">
                            @foreach($similarDocuments as $similarDocument)
                            @if($similarDocument->status == 'Berlaku')
                                <li style="text-align: left; list-style-type: disc; padding-left: 0.5cm;">
                                    <a class="preview-pdf" data-file-id="{{$similarDocument->id}}" role="button" style="font-size: 18px; color: #087cfc; font-weight: 500;" href="{{ route('document-detail', ['id' => $similarDocument->id]) }}">{{$similarDocument->nama_dokumen}}</a>
                                </li>
                            @endif
                        @endforeach

                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>


                                <div class="col-lg-12">
                                    <div class="card" style="width: 650px;">
                                        <div class="card-header" style="background-color: #087cfc; padding: 20px;">
                                            <h3 class="card-title" style="color: white !important; font-size: 20px; font-weight: bold;">Update Status</h3>
                                        </div>
                                        <div class="card-body flex-grow-1">
                                            <!-- Isi similar document -->
                                            <div class="row justify-content-center mb-4">
                                                <div class="col fw-semibold text-center">
                                                    <h4>Dokumen yang digantikan:</h4>
                                                <ol type="a">
                                                    @foreach($similarDocuments as $similarDocument)
                                                    @if($similarDocument->status == 'Berlaku')
                                                        <li style="text-align: left; list-style-type: disc; padding-left: 0.5cm;">
                                                            <a class="preview-pdf" data-file-id="{{$similarDocument->id}}" role="button" style="font-size: 18px; color: #087cfc; font-weight: 500;" href="{{ route('document-detail', ['id' => $similarDocument->id]) }}">{{$similarDocument->nama_dokumen}}</a>
                                                        </li>
                                                    @endif
                                                @endforeach
                                                

                                        
                                        
                                    </ol>

        </ol>



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
    </div>
    <!-- /.content-wrapper -->
        
        <!-- jQuery and Bootstrap JS libraries -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
    </html>
