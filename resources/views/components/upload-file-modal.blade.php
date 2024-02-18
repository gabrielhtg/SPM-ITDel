<button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#modal-success1">
    <i class="fas fa-plus"></i> <span style="margin-left: 5px">Add Document</span>
</button>

<div class="modal fade" id="modal-success1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Upload File</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-register" enctype="multipart/form-data" method="POST" action="{{ route('uploadFile') }}">
                    @csrf
                    <div class="input-group mt-3">
                        <select name="give_access_to[]" class="select2 form-control" multiple="multiple" data-placeholder="Give Access to" style="width: 100%;">
                            @foreach($roles as $e)
                                <option value="{{ $e->id }}">{{ $e->role }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group mt-3">
                        <input type="file" name="file">
                    </div>

                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="form-register" class="btn btn-primary">Upload Document</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
