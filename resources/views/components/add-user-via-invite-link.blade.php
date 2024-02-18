<button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#modal-success2">
    <i class="fas fa-share-alt"></i> <span style="margin-left: 5px">Add User via Link</span>
</button>

<div class="modal fade" id="modal-success2">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add User via Link</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="GET" action="{{ route('register-invitation') }}">
                    @csrf
                    <div class="input-group mt-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" required autocomplete="username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope" style="font-size: 14px"></span>
                            </div>
                        </div>
                    </div>
                    <span class="text-danger">{{ $errors->first('email') }}</span>

                    <div class="input-group mt-3">
                        <select class="form-control" name="role" required>
                            <option value="">-- Select Role --</option>
                            @foreach($roles as $e)
                                <option value="{{ $e->id }}">{{ $e->role }}</option>
                            @endforeachg
                        </select>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-user-tag" style="font-size: 12px"></i>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3"></div>
                    <textarea id="summernote" name="pesan">
                                        Berikut ini kami berikan link yang dapat anda gunakan untuk melakukan pendaftaran.
                                    </textarea>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary mt-4">Send Invitation Link</button>
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
