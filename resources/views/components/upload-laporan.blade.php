<a href="#modal-add-document" class="btn btn-success mb-3" data-toggle="modal">
    <i class="fas fa-plus"></i> <span style="margin-left: 5px">Tambah Laporan</span>
</a>

<div class="modal fade" id="modal-add-document" tabindex="-1" role="dialog" aria-labelledby="modal-add-document-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-add-document-label">Tambah Dokumen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="document-form" enctype="multipart/form-data" method="POST" action="{{ route('laporan.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="document-name">Nama Laporan</label>
                        <input type="text" class="form-control" id="document-name" name="nama_laporan" required>
                    </div>
                    <div class="form-group">
                        <label for="document-type">Tipe Laporan</label>
                        <select class="form-control" id="document-type" name="id_tipelaporan" required>
                            <option value="">Pilih Tipe Laporan</option>
                            @foreach($tipe_laporan as $tipe)
                                <option value="{{ $tipe->id }}">{{ $tipe->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="revisi">Revisi:</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="revisiCheckbox" name="revisi" value="1">
                            <label class="form-check-label" for="revisiCheckbox">Ya</label>
                        </div>
                    </div>
                    
                    
                    <div class="form-group" id="merevisi-laporan" style="display: none;">
                        <label for="menganntikan">Merevisi Laporan:</label>
                        <select class="form-control" id="menganntikan" name="cek_revisi">
                            @php
                            $allServices = new \App\Services\AllServices();
                          
                            @endphp
                            @foreach ($laporan as $item)
                            @php
                                @if(auth()->user()->id == $item->created_by && $item->status=="Ditolak" && $allServices->isLaporanIdInCekLaporan($item->id))
                                    <option value="{{$item->id}}">{{$item->nama_laporan}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    
                    
                    <div class="form-group">
                        <label for="document-file">Dokumen</label>
                        <input type="file" class="form-control-file" id="document-file" name="file" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="document-form">Submit</button>
            </div>
        </div>
    </div>
</div>




<script>
    // Dapatkan elemen checkbox
    var checkbox = document.getElementById('revisiCheckbox');

    // Dapatkan elemen yang akan dimunculkan atau disembunyikan
    var merevisiLaporan = document.getElementById('merevisi-laporan');

    // Tambahkan event listener untuk memantau perubahan pada checkbox
    checkbox.addEventListener('change', function() {
        // Jika checkbox dicentang, maka munculkan elemen
        if (checkbox.checked) {
            merevisiLaporan.style.display = 'block';
        } else {
            // Jika checkbox tidak dicentang, sembunyikan elemen
            merevisiLaporan.style.display = 'none';
        }
    });
</script>
