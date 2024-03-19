<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-role">
    <i class="fas fa-crown"></i> <span style="margin-left: 5px">Manage Role</span>
</button>

<div class="modal fade" id="modal-role">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Manage Role</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="mb-3">
                    <form class="d-flex" action="{{ route("addRole") }}" method="post" style="gap: 10px">
                        @csrf
                        <input placeholder="Insert new role here" name="role" type="text" class="form-control" required>

                        <button class="btn btn-primary" type="submit" style="min-width: 100px">Add Role</button>
                    </form>
                </div>

                <div>
                    <table id="table-role" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>
                                Role
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $e)
                            <tr>
                                <td>
                                    {{$e->role}}
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                            data-target="#modal-delete-role-{{ $e->id }}">
                                        Remove
                                    </button>

                                    <div class="modal fade" id="modal-delete-role-{{ $e->id }}">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Delete Confirmation Dialog</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="form-remove-role-{{ $e->id }}" action="{{ route('removeRole') }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="id" value="{{ $e->id }}">
                                                    </form>

                                                    <p>
                                                        Are you sure to remove role <strong>{{ $e->role }}</strong>? All users who have this role will lose this role.
                                                    </p>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" form="form-remove-role-{{ $e->id }}" class="btn btn-danger">Ok</button>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
