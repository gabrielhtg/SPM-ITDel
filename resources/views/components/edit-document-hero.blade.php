<!-- Button trigger modal -->
<button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#modal-hero">
    <i class="fas fa-plus"></i> <span style="margin-left: 5px">Edit Hero</span>
</button>

<!-- Modal -->
<div class="modal fade" id="modal-hero">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Hero</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-addHerosection" method="POST" action="{{ route('hero.update', ['id' => $documenthero->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group mt-1">
                        <label for="title">Judul Besar</label>
                        <input type="text" name="titlehero" id="titlehero" class="form-control" required value="{{ $documenthero->titlehero }}">
                    </div>
                
                    <label for="summernote">Keterangan Tambahan</label>
                    <textarea class="summernote" name="descriptionhero">{{ $documenthero->descriptionhero }}</textarea>
                
                    <div class="form-group">
                        <label for="exampleInputFile">Unggah Walpaper</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file" name="imagehero" onchange="displayFileName()">
                                <label class="custom-file-label" for="file" id="file-label">Pilih File</label>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function displayFileName() {
    // Mendapatkan input file
    var input = document.getElementById('file');
    // Mendapatkan label
    var label = document.getElementById('file-label');
    // Mendapatkan nama file yang dipilih
    var fileName = input.files[0].name;
    // Menampilkan nama file dalam label
    label.innerHTML = fileName;
}
</script>
