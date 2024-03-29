

<div class="modal fade" id="modal-edit-role">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Role</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-add-role" action="{{route('addRole')}}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="nama-role">Role Name</label>
                        <input type="text" class="form-control" placeholder="Type Here" id="nama-role" name="nama_role" required autofocus>
                    </div>

                    <div class="form-group mt-3">
                        <label for="atasan-role">Atasan</label>
                        <select id="atasan-role" name="atasan_role" class="form-control" style="width: 100%">
                            <option></option>
                            @foreach($roles as $e)
                                @if($e->role !== "Admin")
                                    <option value="{{ $e->id }}">{{ $e->role }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <label for="accountable-to">Accountable To:</label>
                        <select id="accountable-to" name="accountable_to[]" multiple="multiple" class="form-control" style="width: 100%">
                            <option></option>
                            @foreach($roles as $e)
                                @if($e->role !== "Admin")
                                    <option value="{{ $e->id }}">{{ $e->role }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <label for="informable-to">Informable To:</label>
                        <select id="informable-to" name="informable_to[]" class="form-control" multiple="multiple" style="width: 100%">
                            <option></option>
                            @foreach($roles as $e)
                                @if($e->role !== "Admin")
                                    <option value="{{ $e->id }}">{{ $e->role }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="form-add-role">Add</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
