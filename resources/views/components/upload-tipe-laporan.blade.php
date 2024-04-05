<a href="#modal-successlaporan" class="btn btn-success mb-3" data-toggle="modal">
    <i class="fas fa-plus"></i> <span style="margin-left: 5px">Tambah Tipe Laporan</span>
</a>
<div class="modal fade" id="modal-successlaporan">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Document Type</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-register" method="POST" action= "{{ route('uploadTypeLaporan') }}">
                    @csrf

                    <div class="form-group">
                        <label for="jenis_dokumen">Document Type</label>
                        <input type="text" name="nama_laporan" placeholder="Document Type" class="form-control" required>
                        <div class="invalid-feedback">Please provide a valid document type.</div>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
