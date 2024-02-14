<button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#modal-list-invited-user">
    <i class="fas fa-link"></i> <span style="margin-left: 5px">List Invited User</span>
    @if(count($invitation) != 0)
        <span class="badge badge-primary" style="margin-left: 5px">{{ count($invitation) }}</span>
    @endif
</button>

<div class="modal fade" id="modal-list-invited-user">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">List Invited User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Invited At</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($invitation as $e)
                            <tr>
                                <td>{{ $e->email }}</td>
                                <td>{{ app(\App\Services\CustomConverterService::class)->convertRole($e->role) }}</td>
                                <td>{{ $e->updated_at }}</td>
                                <td>
                                    <form action="{{ route('delete-invitation') }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $e->id }}">
                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="4">There is no active invitation link.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    @if($invitation->count() != 0)
                        <form action="{{ route('clear-invitation') }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger mt-4">Clear Invitation Link</button>
                        </form>
                    @endif

                </div>
            </div>
                <div class="modal-footer justify-content-between">
                    <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
