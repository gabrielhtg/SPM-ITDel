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
            <form action="{{ route('laporan.reject', ['id' => $lap->id]) }}" method="POST" id="commentForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="commentContent">Isi Komentar</label>
                        <textarea class="form-control" id="commentContent" name="komentar" rows="3" placeholder="Tulis komentar Anda di sini..." required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="document-file">Tambahkan File</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="file" class="custom-file-input" id="document-file" onchange="displayFileName()" required>
                                <label class="custom-file-label" for="document-file" id="file-label">Pilih file</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" >Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Penolakan -->
<div class="modal fade" id="rejectConfirmationModal" tabindex="-1" aria-labelledby="rejectConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-black">
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
                <button type="submit" class="btn btn-danger" name="submit" >Ya</button>
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
    function displayFileName() {
        // Mendapatkan input file
        var input = document.getElementById('document-file');
        // Mendapatkan label
        var label = document.getElementById('file-label');
        // Mendapatkan nama file yang dipilih
        var fileName = input.files[0].name;
        // Menampilkan nama file dalam label
        label.innerHTML = fileName;
    }
</script>
