<button type="button" class="btn btn-warning" style="width: 180px" data-toggle="modal" data-target="#modal-change-password">
    <span style="margin-left: 5px"><b>Ganti Kata Sandi</b></span>
</button>

<div class="modal fade" id="modal-change-password">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Change Password</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-change-password" method="POST" action="{{ route('change-password') }}">
                    @csrf
                    <div class="input-group">
                        <input type="password" name="current_password" class="form-control" placeholder="Current Password" required autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>
                    </div>
                    <span class="text-danger">{{ $errors->first('current_password') }}</span>

                    <div class="input-group mt-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>
                    </div>
                    <span class="text-danger">{{ $errors->first('password') }}</span>

                    <div class="input-group mt-3">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Re-Enter Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>
                    </div>
                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="form-change-password" class="btn btn-primary"><i class="far fa-save mr-1"></i> Save</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
