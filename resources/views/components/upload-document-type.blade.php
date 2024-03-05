
<button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#modal-success2">
    <i class="fas fa-plus"></i> <span style="margin-left: 5px">Add Document Type</span>
</button>

<div class="modal fade" id="modal-success2">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Document Type</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-register" method="POST" action="{{ route('uploadTypeDocument') }}">
                    @csrf

                    <div class="input-group">
                        <input type="text" name="jenis_dokumen" placeholder="Document Type" class="form-control" required>
                    </div>
                
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
