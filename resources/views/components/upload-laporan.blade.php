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
                                <option value="{{ $tipe->id }}">{{ $tipe->nama_laporan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Berikan Akses Kepada:</label>
                        <select name="tujuan[]" class="select2 form-control" multiple="multiple" data-placeholder="Berikan Akses Kepada" style="width: 100%;">
                            <option value="0">Public</option>
                            @foreach($roles as $role)
                            
                                <option value="{{ $role->id }}">{{ $role->role }}</option>
                            @endforeach
                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="revisi">Revisi:</label>
                        <select class="form-control" id="revisi" name="revisi">
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
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
