<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete-{{ $id }}">
    <i class="fas fa-trash"></i>
</button>

<div class="modal fade" id="modal-delete-{{ $id }}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Konfirmasi Penghapusan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-delete-{{ $id }}" method="POST" action="{{ route($route) }}">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="{{ $e->id }}">
                </form>

                <p>
                    Apakah Anda yakin ingin menghapus data {{ $name }}?
                </p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" form="form-delete-{{ $id }}" class="btn btn-danger">Hapus</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>