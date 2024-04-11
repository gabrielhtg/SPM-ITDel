<a href="#modal-successlaporan1" class="btn btn-success mb-3" data-toggle="modal">
    <i class="fas fa-plus"></i> <span style="margin-left: 5px">Tambah Jenis Laporan</span>
</a>

<div class="modal fade" id="modal-successlaporan1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Jenis Laporan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-register" method="POST" action="{{ route('uploadJenisLaporan') }}">
                    @csrf
                    <div class="form-group">
                        <label for="document-type">Tipe Laporan</label>
                        <select class="form-control" id="id_tipelaporan" name="id_tipelaporan" required>
                            <option value="">Pilih Tipe Laporan</option>
                            @foreach($tipe_laporan as $tipe)
                                <option value="{{ $tipe->id }}">{{ $tipe->nama_laporan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nama_laporan">Jenis Laporan:</label>
                        <input type="text" id="nama" name="nama" placeholder="Jenis Dokumen" class="form-control" required>
                        <div class="invalid-feedback">Harap masukkan jenis dokumen yang valid.</div>
                    </div>

                    <div class="form-group">
                        <label for="start_date">Tanggal Mulai:</label>
                        <input type="datetime-local" id="start_date" name="start_date" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="end_date">Tanggal Berakhir:</label>
                        <input type="datetime-local" id="end_date" name="end_date" class="form-control">
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
