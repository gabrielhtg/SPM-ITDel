<button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#modal-list-password-reset">
    <i class="fas fa-redo"></i> <span style="margin-left: 5px">List Password Reset Request</span>
    @if(count($pass_reset) != 0)
        <span class="badge badge-primary" style="margin-left: 5px">{{ count($pass_reset) }}</span>
    @endif
</button>


<div class="modal fade" id="modal-list-password-reset">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">List of password resets requested by the user</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Last Requested At</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($pass_reset as $e)
                            <tr>
                                <td>
                                    <div class="user-panel d-flex">
                                        <div class="info">
                                            <span class="d-block"> {{ $e->email }} </span>
                                         </div>
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $userTemp = \App\Models\User::where("email", $e->email)->first();
                                    @endphp

                                    <div class="user-panel d-flex">
                                        <div class="image">
                                            @if($userTemp->profile_pict == null)
                                                <img src="{{ asset('src/img/default-profile-pict.png') }}" class="img-circle custom-border" alt="User Image">
                                            @else
                                                <img src="{{ asset($userTemp->profile_pict) }}" class="img-circle custom-border" alt="User Image">
                                            @endif
                                        </div>
                                        <div class="info">
                                            <span class="d-block">{{ $userTemp->name }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{ $e->updated_at }}
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <form action="{{ route('accept-reset-request') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="email" value="{{ $e->email }}">
                                            <button type="submit" class="btn btn-success mr-2"><i class="fas fa-check" style="font-size: 14px"></i></button>
                                        </form>
                                        <form action="{{ route('delete-reset-request') }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <input type="hidden" name="email" value="{{ $e->email }}">
                                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="5">There is no password reset request.</td>
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
