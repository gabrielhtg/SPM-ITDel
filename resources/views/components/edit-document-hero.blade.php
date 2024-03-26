<button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#modal-hero">
    <i class="fas fa-plus"></i> <span style="margin-left: 5px">Edit Hero</span>
</button>

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
                <form id="form-addHerosection" method="POST" action="{{ route('dashboard-herosection-add') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mt-1">
                        <label for="title">Judul Besar</label>
                        <input type="text" name="judulhero" id="judulhero" class="form-control" required>
                    </div>

                    <label for="summernote">Keterangan Tambahan</label>
                    <textarea class="summernote" name="tambahanhero"></textarea>

                    <div class="form-group">
                        <label for="exampleInputFile">Walpeper Input</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file" name="gambarhero">
                                <label class="custom-file-label" for="file">Choose file</label>
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