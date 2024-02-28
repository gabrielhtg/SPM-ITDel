
<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-detail-document-{{ $e->id }}"><i class="fas fa-info-circle fa-inverse"></i></button>
<div class="modal fade" id="modal-detail-document-{{ $e->id }}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Dokumen</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Nama Dokumen:</strong> {{ $e->name}}</p>
                <p><strong>Tipe Dokumen:</strong> {{ $e->tipe_dokumen }}</p>
                <p><strong>Nomor Dokumen:</strong> {{ $e->nomor_dokumen }}</p>
                <p><strong>Tahun:</strong> {{ $e->year }}</p>
                <p><strong>User Upload:</strong> {{ $uploadedUsers->where('id', $e->created_by)->first()->name }}</p>
                <p><strong>Created At:</strong> {{ $e->created_at }}</p>
                <p><strong>Tanggal Berlaku:</strong> {{ $e->expried_date }}</p>
                <p><strong>Status:</strong> {{ $e->status }}</p>
                <!-- Anda dapat menambahkan atribut tambahan sesuai kebutuhan -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>