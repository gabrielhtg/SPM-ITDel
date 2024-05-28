<button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#modal-akreditasi">
    <i class="fas fa-plus"></i><span style="margin-left: 5px">Tambahkan Akreditasi ITDel</span>
</button>

<div class="modal fade" id="modal-akreditasi">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambahkan Akreditasi </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-addAkreditasisection" method="POST" action="{{ route('dashboard-akreditasi-add') }}" enctype="multipart/form-data">
                    @csrf
                    <label for="summernote">Keterangan Akreditasi</label>
                    <textarea class="summernote" name="keteranganakreditasi"></textarea>

                    <div class="form-group">
                        <label for="exampleInputFile">gambar akreditasi</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="gambarakreditasi" name="gambarakreditasi">
                                <label class="custom-file-label" for="file">Choose Image</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="form-addAkreditasisection" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
    document.getElementById('gambarakreditasi').addEventListener('change', function(e) {
        var fileName = document.getElementById('gambarakreditasi').files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
</script>