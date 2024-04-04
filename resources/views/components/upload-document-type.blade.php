<button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#modal-success2">
    <i class="fas fa-plus"></i> <span style="margin-left: 5px">Tambahkan Tipe Dokumen</span>
</button>

<div class="modal fade" id="modal-success2">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambahkan Tipe Dokumen</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-register" method="POST" action="{{ route('uploadTypeDocument') }}">
                    @csrf

                    <div class="form-group">
                        <label for="jenis_dokumen">Tipe Dokumen</label>
                        <input type="text" name="jenis_dokumen" placeholder="Tipe Dokumen" class="form-control" required>
                        <div class="invalid-feedback">Harap berikan jenis dokumen yang valid.</div>
                    </div>

                    <div class="form-group">
                        <label for="singkatan">Singkatan</label>
                        <input type="text" name="singkatan" placeholder="Singkatan" class="form-control" required>
                        <div class="invalid-feedback">Harap berikan singkatan yang valid.</div>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Tambahkan</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
