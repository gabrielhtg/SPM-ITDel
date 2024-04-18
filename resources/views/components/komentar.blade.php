<!-- Button trigger modal -->
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#commentModal">
    <i class="fas fa-times" style="font-size: 14px;"></i>
</button>

<!-- Modal Komentar -->
<div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Konfirmasi Penolakan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('laporan.reject', ['id' => $lap->id]) }}" method="POST" id="commentForm">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="commentContent">Isi Komentar</label>
                        <textarea class="form-control" id="commentContent" name="komentar" rows="3" placeholder="Tulis komentar Anda di sini..." required></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="confirmReject()">Kirim</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Penolakan -->
<div class="modal fade" id="rejectConfirmationModal" tabindex="-1" aria-labelledby="rejectConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="rejectConfirmationModalLabel">Konfirmasi Penolakan</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menolak laporan ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                <button type="button" class="btn btn-danger" onclick="submitForm()">Ya</button>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmReject() {
        $('#commentModal').modal('hide'); // Menyembunyikan modal komentar
        $('#rejectConfirmationModal').modal('show');
    }

    function submitForm() {
        $('#commentForm').submit();
    }
</script>
