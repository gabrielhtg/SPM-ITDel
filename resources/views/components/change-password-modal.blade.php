<button type="button" class="btn btn-warning" style="width: 180px" data-toggle="modal" data-target="#modal-change-password">
    <span style="margin-left: 5px"><b>Change Password</b></span>
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
                <form id="form-register" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="input-group">
                        <input type="password" name="password" class="form-control" placeholder="Password" required autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mt-3">
                        <input type="password" name="reenter-password" class="form-control" placeholder="Re-Enter Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>
                    </div>
                    <span class="text-danger">{{ $errors->first('edit') }}</span>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="form-register" class="btn btn-primary"><i class="far fa-save mr-1"></i> Save</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
