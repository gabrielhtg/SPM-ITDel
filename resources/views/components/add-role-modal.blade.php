<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-role">
    <i class="fas fa-plus"></i> <span style="margin-left: 5px">Add Role</span>
</button>

<div class="modal fade" id="modal-role">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Role Role</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('addRole')}}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="nama-role">Role Name</label>
                        <input type="text" class="form-control" placeholder="Type Here" id="nama-role" name="nama-role" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="atasan-role">Atasan</label>
                        <select id="atasan-role" name="atasan-role" class="select2 form-control" required>
                            <option></option>
                            @foreach($roles as $e)
                                <option value="{{ $e->id }}">{{ $e->role }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
