<button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#modal-hero">
    <i class="fas fa-plus"></i><span style="margin-left: 5px">Add Hero Section</span>
</button>

<div class="modal fade" id="modal-hero">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Hero Section</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-addHerosection" method="POST" action="{{ route('dashboard-herosection-add') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputFile">Profil Image Input</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file" name="profilhero">
                                <label class="custom-file-label" for="file">Choose Image</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-1">
                        <label for="title">Judul Besar</label>
                        <input type="text" name="judulhero" id="judulhero" class="form-control" required>
                    </div>

                    <label for="summernote">Keterangan Tambahan</label>
                    <textarea class="summernote" name="tambahanhero"></textarea>

                    <div class="form-group">
                        <label for="exampleInputFile">Background Input</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="filegambarhero" name="gambarhero">
                                <label class="custom-file-label" for="file">Choose Image</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="form-addHerosection" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
    document.getElementById('file').addEventListener('change', function(e) {
        var fileName = document.getElementById('file').files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
</script>

<script>
    document.getElementById('filegambarhero').addEventListener('change', function(e) {
        var fileName = document.getElementById('filegambarhero').files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
</script>