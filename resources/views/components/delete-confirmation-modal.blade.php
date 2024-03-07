<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete-{{ $id }}">
    <i class="fas fa-trash"></i>
</button>

<div class="modal fade" id="modal-delete-{{ $id }}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Confirmation Dialog</h4>
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
                    Are you sure to delete data {{ $name }}?
                </p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="form-delete-{{ $id }}" class="btn btn-danger">Remove</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>